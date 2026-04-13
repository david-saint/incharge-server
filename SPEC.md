# InCharge Server — Complete Rebuild Specification

## 1. System Overview

**InCharge** is a family-planning / contraceptive-guidance backend. It serves two distinct surfaces:

1. **REST API (v1)** — JSON API consumed by mobile/web client applications. Uses JWT authentication.
2. **Admin Web Panel** — A server-rendered (or SPA-backed) admin interface for managing users, clinics, admins, algorithms, and reference data. Uses session-based cookie authentication.

The domain is `incharge.com.ng`. The app references two configurable sub-domain variables:
- `APP_URL` / `api-domain` — the server's own domain
- `user-domain` — the frontend app domain (e.g., `accounts.incharge.com.ng`), used to build password-reset and email-verified redirect URLs

---

## 2. Technology Dependencies (language-agnostic)

| Concern | Description |
|---|---|
| Database | MySQL (relational). All entities have `created_at` / `updated_at` timestamps. Several use soft-deletes (`deleted_at`). |
| User Auth | JWT (access token). Token is returned in both the JSON body and `Authorization: Bearer` response header. |
| Admin Auth | Session cookie (web) + password hashing. |
| Email | SMTP transactional email for verification and password reset. |
| Passwords | Bcrypt hashing. |
| CORS | Fully open (`*` on origins, headers, methods). Expose `Authorization` header. |
| Rate limiting | 120 API requests/minute/IP. Email verification and resend: throttle 6/minute. |

---

## 3. Database Schema

### 3.1 `users`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK, auto-increment | |
| name | string | |
| email | string, unique | |
| email_verified_at | timestamp, nullable | Set when email is verified |
| phone | string | Validated for NG/US phone formats; unique |
| phone_confirmed_at | timestamp, nullable | Reserved for future phone confirmation |
| password | string | Bcrypt hash |
| remember_token | string, nullable | |
| deleted_at | timestamp, nullable | Soft delete |
| created_at, updated_at | timestamps | |

### 3.2 `profiles`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| user_id | integer, FK → users.id | One-to-one with user |
| age | integer unsigned | |
| gender | enum: MALE, FEMALE, OTHER | |
| date_of_birth | datetime | |
| address | text | |
| latitude | decimal(10,7), nullable | User's location |
| longitude | decimal(10,7), nullable | |
| marital_status | enum: SINGLE, RELATIONSHIP | |
| height | integer unsigned, nullable | Centimeters |
| weight | decimal, nullable | Kilograms |
| education_level_id | integer, nullable, FK → education_levels.id | |
| occupation | string, nullable | |
| number_of_children | integer unsigned, nullable | |
| contraception_reason_id | integer, FK → contraception_reasons.id | |
| sexually_active | boolean | |
| pregnancy_status | boolean | |
| religion | enum: CHRISTIANITY, ISLAM, OTHER | |
| religion_sect | enum: CATHOLIC, PENTECOSTAL, OTHER; nullable | Required only when religion = CHRISTIANITY |
| meta | json, nullable | Stores `contraceptive_plan` (and other future fields) as a JSON object |
| created_at, updated_at | timestamps | |

### 3.3 `clinics`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| name | string | |
| address | text | |
| latitude | decimal(10,7), nullable | |
| longitude | decimal(10,7), nullable | |
| added_by_id | integer | ID of the admin who added the clinic |
| deleted_at | timestamp, nullable | Soft delete |
| meta | json, nullable | |
| created_at, updated_at | timestamps | |

### 3.4 `locations`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | Neighbourhood/LGA/city-level area |
| name | string | |
| state_id | integer, FK → states.id | |
| country_id | integer, FK → countries.id | |
| latitude | decimal(10,7), nullable | |
| longitude | decimal(10,7), nullable | |
| deleted_at | timestamp, nullable | Soft delete |
| meta | json, nullable | |
| created_at, updated_at | timestamps | |

### 3.5 `locatables` (polymorphic pivot)
Associates one or more `locations` with any entity (currently `clinics`).

| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| location_id | integer, FK → locations.id | |
| locatable_id | integer | Polymorphic FK |
| locatable_type | string | Polymorphic type (e.g., `App\Models\Clinic`) |
| created_at, updated_at | timestamps | |

### 3.6 `states`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| name | string | |
| slug | string, unique | URL-safe identifier |
| latitude | decimal(10,7), nullable | |
| longitude | decimal(10,7), nullable | |
| deleted_at | timestamp, nullable | Soft delete |
| meta | json, nullable | |
| created_at, updated_at | timestamps | |

### 3.7 `countries`
| Column | Type | Notes |
|---|---|---|
| id | integer, PK | |
| name | string | |
| code | string, unique | ISO country code |
| created_at, updated_at | timestamps | |

### 3.8 `contraception_reasons`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| value | string | Human-readable reason |
| deleted_at | timestamp, nullable | Soft delete |
| created_at, updated_at | timestamps | |

### 3.9 `education_levels`
| Column | Type | Notes |
|---|---|---|
| id | integer, PK | |
| name | string | Degree/qualification name |
| created_at, updated_at | timestamps | |

### 3.10 `faq_groups`
| Column | Type | Notes |
|---|---|---|
| id | integer, PK | |
| name | string | E.g., "Barrier Method", "Implants" |
| created_at, updated_at | timestamps | |

### 3.11 `faqs`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| faq_group_id | integer, FK → faq_groups.id | |
| content | json, nullable | Structured FAQ content (supersedes old `question`/`answer` text columns) |
| deleted_at | timestamp, nullable | Soft delete |
| created_at, updated_at | timestamps | |

Each `faq_group` has at most one `faq` (one-to-one).

### 3.12 `algorithms`
Represents a node/step in a decision-tree that guides the user to a contraceptive plan recommendation.

| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| text | text | The question or statement shown to the user |
| actionType | enum: bool, input, date; nullable | Type of expected input. `null` = informational/statement only |
| positive | string, nullable | Label for the "yes/positive" answer option |
| negative | string, nullable | Label for the "no/negative" answer option |
| onPositive | integer, nullable | FK-like: ID of next algorithm step when user answers positively |
| onNegative | integer, nullable | FK-like: ID of next algorithm step when user answers negatively |
| nextMove | integer, nullable | Default next step ID (for non-branching steps) |
| tempPlan | string, nullable | A contraceptive plan tentatively suggested at this step |
| tempPlanDirP | string, nullable | Temp plan assigned on the positive path |
| tempPlanDirN | string, nullable | Temp plan assigned on the negative path |
| conditionalFactor | string, nullable | Profile field key to evaluate as a condition (e.g., `age`, `religion`) |
| conditionalOperator | string, nullable | Comparison operator (e.g., `>`, `=`, `<`) |
| conditionalValue | string, nullable | Value to compare the profile field against |
| stateValue | string, nullable | A stateful value to track during the algorithm traversal |
| label | string, nullable | An internal label/identifier for this step |
| progestogenPossible | enum: true, false; nullable | Whether a progestogen-only option is applicable at this step |
| progestogenPossibleDir | enum: positive, negative; nullable | Which answer direction enables the progestogen option |
| delay | integer | Ordering/sequencing number within the flow |
| series | integer, nullable | Groups steps into a numbered series |
| active | enum: Y, N; default N | Whether this step is part of the published/active algorithm |
| deleted_at | timestamp, nullable | Soft delete |
| created_at, updated_at | timestamps | |

### 3.13 `admins`
| Column | Type | Notes |
|---|---|---|
| id | bigint, PK | |
| firstname | string | |
| lastname | string | |
| phone | string, nullable | |
| email | string, unique | |
| verified | enum: Y, N; default N | Admin must be verified to access the panel |
| userType | enum: Super, Sub | Super admin has full access; Sub admin requires verification |
| password | string | Bcrypt hash |
| accessToken | text, nullable | OAuth access token stored on admin record |
| remember_token | string, nullable | |
| deleted_at | timestamp, nullable | Soft delete |
| created_at, updated_at | timestamps | |

### 3.14 `password_resets`
| Column | Type | Notes |
|---|---|---|
| email | string, indexed | |
| token | string | |
| created_at | timestamp, nullable | |

---

## 4. Seed / Reference Data

These values must be seeded on a fresh deployment:

**Contraception Reasons:**
1. Completed family size
2. Child Spacing
3. Sexually Active with no plan for children at the moment

**Education Levels (14):**
BArch, BA, B.Sc, B.ENG, LLB, HNC, HND, ND, M.Sc, M.Eng, Phd., Prof, B.Tech, Other

**FAQ Groups (13):**
Barrier Method, Combined Oral Contraceptives, Diaphragms and Spermicides, Emergency Contraceptive Pills, Female Sterilization, Fertility Awareness, Implants, Injectables, IUCD, Lactational Amenorrhea, Progestin Only Pills, STIs, Vasectomy

**Algorithms:** Loaded from an SQL seed file (`algorithms.sql`). Contains the full decision tree for contraceptive guidance. The tree consists of sequential and branching nodes. When all steps are complete, a contraceptive plan string is stored on the user's profile.

**Locations / States / Countries:** Seeded from generated CSV-based seeders covering Nigeria (states and LGAs/localities) and additional countries.

---

## 5. API Routes (v1 JSON REST API)

All routes under `/api/v1/`. The base path structure is `/api/{version}/{context}/{resource}`.

### 5.1 Rate Limiting & CORS
- All API routes: 120 requests/minute per IP
- CORS: allow all origins, all headers, all methods; expose `Authorization` header

### 5.2 Public (Global) Routes — `/api/v1/global/`

| Method | Path | Description | Auth |
|---|---|---|---|
| GET | `/` | Health check — returns "Hello, World!" | None |
| GET | `/contraception-reasons` | List all contraception reasons | None |
| GET | `/contraception-reasons/{id}` | Get a single contraception reason | None |
| GET | `/education-levels` | List all education levels | None |
| GET | `/faq-groups` | List all FAQ groups | None |
| GET | `/faq-groups/{id}` | Get the FAQ content for a group | None |

**Response shapes:**
- Contraception reason: `{ id, value, profiles? }`
- Education level / generic named: `{ id, name }`
- FAQ group: `{ id, name, created_at, updated_at }`
- FAQ content response: `{ data: <faq content json>, status: "faq.get_content" }`

### 5.3 User Auth Routes — `/api/v1/user/`

| Method | Path | Description | Auth |
|---|---|---|---|
| POST | `/register` | Register a new user | None |
| POST | `/login` | Login and receive JWT | None |
| POST | `/logout` | Logout / invalidate JWT | None |
| GET | `/refresh` | Refresh JWT token | None |
| POST | `/password/email` | Request a password-reset email | None |
| POST | `/password/reset` | Reset password using token | None |
| GET | `/email/verify/{id}` | Verify email address via signed URL | Signed URL |
| GET | `/email/resend` | Resend verification email | JWT |
| GET | `/email/success` | Email verification success response | None |

**Register request:**
```
name        (required)
email       (required, unique, valid email)
phone       (optional, NG/US phone format, unique)
password    (required, min 6 chars)
```
On success: fire registration event → sends verification email; return `{ status: true, message, data: <user resource> }`.

**Login request:** `email`, `password`
- On failure: `422 { errors: { email: ["These credentials do not match our records."] } }`
- On success: `200 { token: "..." }` + `Authorization: Bearer <token>` response header

**Logout:** Invalidates the current JWT. Returns `{ status: true, message: "Successfully logged out." }`

**Refresh:** Returns new token in same format as login.

**Password reset email request:** `email` (required, valid email). Returns `{ message: "..." }` on success, `422 { errors: { email: [...] } }` on failure.

**Password reset:** `email`, `token`, `password`, `password_confirmation`. Standard token-based reset.

**Email verification:** Triggered via a signed URL with a 4320-minute (72-hour) expiry. On success, redirects to `{user-domain}/email-verified`.

**User resource shape:**
```json
{
  "id": 1,
  "name": "...",
  "email": "...",
  "phone": "...",
  "email_verified": true,
  "phone_confirmed": false,
  "profile": "<profile resource, if loaded>",
  "created_at": "...",
  "updated_at": "..."
}
```

### 5.4 Authenticated User Endpoint

| Method | Path | Description | Auth |
|---|---|---|---|
| GET | `/api/v1/user/` | Get the authenticated user | JWT (user guard) |

Returns the user resource for the currently authenticated user.

### 5.5 Profile Routes — `/api/v1/user/profile/`

All require JWT auth (user guard).

| Method | Path | Description |
|---|---|---|
| POST | `/` | Create or update the authenticated user's profile |
| GET | `/` | Get the authenticated user's profile |
| POST | `/algorithm` | Store the algorithm-generated contraceptive plan |

**Profile save request fields:**

| Field | Validation | Default |
|---|---|---|
| gender | required, enum: MALE/FEMALE/OTHER | — |
| age | numeric | 0 |
| dob | date | current date/time |
| address | string | `""` |
| marital_status | nullable, enum: SINGLE/RELATIONSHIP | SINGLE |
| height | numeric | — |
| weight | numeric | — |
| education_level | integer, FK education_levels.id | 14 (Other) |
| occupation | string | — |
| children | numeric | 0 |
| reason | nullable, integer, FK contraception_reasons.id | 3 |
| sexually_active | boolean | false |
| pregnancy_status | boolean | false |
| religion | nullable, enum: CHRISTIANITY/ISLAM/OTHER | OTHER |
| religion_sect | required if religion=CHRISTIANITY, enum: CATHOLIC/PENTECOSTAL/OTHER | — |

If a profile already exists for the user, update it; otherwise create it. Returns `201` with the profile resource.

**Profile resource shape:**
```json
{
  "id": 1,
  "age": 25,
  "gender": "FEMALE",
  "date_of_birth": "...",
  "address": "...",
  "latitude": null,
  "longitude": null,
  "marital_status": "SINGLE",
  "height": 165,
  "weight": 60.0,
  "occupation": "...",
  "children": 0,
  "sexually_active": false,
  "pregnancy_status": false,
  "religion": "OTHER",
  "religion_sect": null,
  "reason": "<contraception reason resource, if loaded>",
  "education_level": "<generic named resource, if loaded>"
}
```

**Profile GET** supports `?with=user,reason,educationLevel` to eager-load relationships.

**Algorithm plan request:** `plan` (required). Stores the plan string into `profile.meta.contraceptive_plan`. Returns `{ status, message, data: <plan value> }`.

### 5.6 Clinic Routes — `/api/v1/user/clinics/`

| Method | Path | Auth | Description |
|---|---|---|---|
| GET | `/` | None | List/search clinics (full query capabilities) |
| GET | `/getClinics` | Session (isLogged) | Simple paginated clinic list (50/page) |
| GET | `/deletedClinics` | Session (isLogged) | List soft-deleted clinics |
| POST | `/addClinic` | Session (isLogged) | Create a clinic |
| PUT | `/update/{clinic_id}` | Session (isLogged) | Update a clinic |
| PUT | `/revertDelete/{clinic_id}` | Session (isLogged) | Restore a soft-deleted clinic |
| DELETE | `/deleteClinic/{clinic_id}` | Session (isLogged) | Soft-delete a clinic |

**Clinic list query parameters:**

| Parameter | Description |
|---|---|
| `search` | Free-text OR search across `id`, `name`, `address`, and `locations.name` |
| `latitude` + `longitude` | When both present, adds haversine distance calculation per clinic |
| `radius` | Filter to clinics within this many km/mi of the given coordinates. Default: 10 |
| `mode` | `km` (default) or `mi` |
| `sort` | Comma-separated sort directives: `column\|asc` or `column\|desc`. Supports `distance\|asc` when lat/lng present |
| `with` | Comma-separated relationships to eager-load. Allowed: `locations` |
| `page` + `per_page` | Pagination. Default per_page: 20. When absent, returns all results |
| `withTrashed` | Include soft-deleted records |
| `onlyTrashed` | Return only soft-deleted records |
| `withCount` | Comma-separated relationships to count |

**Clinic resource shape:**
```json
{
  "id": 1,
  "name": "...",
  "address": "...",
  "latitude": 6.5,
  "longitude": 3.3,
  "created_at": "...",
  "mode": "km",
  "radius": 10,
  "search_radius": "10km",
  "actual_distance": 2.34,
  "distance": "2.34km",
  "locations": []
}
```
`mode`, `radius`, `search_radius`, `actual_distance`, and `distance` are only present when the distance filter is active (lat/lng provided). `locations` only appears when `?with=locations`.

**Location resource shape:**
```json
{
  "id": 1,
  "name": "...",
  "state_id": 5,
  "latitude": 6.5,
  "longitude": 3.3,
  "state": "<state resource, if loaded>",
  "country": "<country resource, if loaded>",
  "clinics": ["<generic named resources>"]
}
```

**Create/update clinic request fields:** `name` (required, string), `address` (required, string), `latitude` (required, numeric), `longitude` (required, numeric), `added_by_id` (required, numeric)

### 5.7 User Management Routes — `/api/v1/user/users/`

All require `isLogged` (session check).

| Method | Path | Description |
|---|---|---|
| GET | `/` | List all users with profile, educationLevel, and reason (paginated 50/page) |
| GET | `/deletedUser` | List soft-deleted users |
| PUT | `/update/{user_id}` | Restore a soft-deleted user |
| DELETE | `/deleteUser/{user_id}` | Soft-delete a user |

---

## 6. Admin Web Panel Routes

These are server-rendered HTML pages backed by a Vue.js SPA shell for the main panel. Authentication is session cookie-based (not JWT).

### 6.1 Public Web Routes

| Method | Path | Description |
|---|---|---|
| GET | `/` | If no Super admin exists → show registration form; else → redirect to `/loginView` |
| GET | `/loginView` | Admin login form |
| POST | `/login` | Process login: validate email + password + `verified = 'Y'`; return `200` or `501` |
| GET | `/logout` | Logout, invalidate session, redirect to `/admin` |
| GET | `/privacy` | Static privacy policy page |

### 6.2 Protected Web Routes (require verified admin session)

**Admin management:**

| Method | Path | Description |
|---|---|---|
| GET | `/panel` | Admin dashboard (renders Vue shell) |
| POST | `/admin` | Create a new admin (firstname, lastname, email, phone, password, verified, userType). Generates an access token. On first Super admin, auto-logs them in. |
| GET | `/allAdmins` | Paginated list of admins (50/page), ordered by `verified DESC` |
| GET | `/getAdminDet` | Get the currently logged-in admin's details |
| PUT | `/updateAdmin/{admin_id}` | Update admin fields: firstname, lastname, phone, email, verified, userType, accessToken |

**Algorithm management:**

| Method | Path | Description |
|---|---|---|
| GET | `/algo` | List all algorithms ordered by `active ASC, id ASC` (publicly accessible) |
| POST | `/algo` | Create a new algorithm step (protected) |
| PUT | `/algo/{id}` | Update an existing algorithm step (protected) |

**User management:**

| Method | Path | Description |
|---|---|---|
| GET | `/getUsers` | Paginated user list (50/page) with profile, educationLevel, reason |
| PUT | `/updateUser/{user_id}` | Restore a soft-deleted user |
| DELETE | `/deleteUser/{user_id}` | Soft-delete a user |
| GET | `/getDeletedUsers` | List all soft-deleted users |
| PUT | `/revertDeletedUser/{user_id}` | Restore a soft-deleted user |

**Clinic management:**

| Method | Path | Description |
|---|---|---|
| GET | `/getClinics` | Paginated clinic list (50/page) |
| POST | `/addClinic` | Create a clinic |
| PUT | `/updateClinic/{clinic_id}` | Update a clinic |
| DELETE | `/deleteClinic/{clinic_id}` | Soft-delete a clinic |
| GET | `/getDeletedClinics` | List soft-deleted clinics |
| PUT | `/revertDeletedClinic/{clinic_id}` | Restore a soft-deleted clinic |

**Reference data:**

| Method | Path | Description |
|---|---|---|
| GET | `/getContraceptionReason` | List all contraception reasons |
| GET | `/getEducationalLevels` | List all education levels |

---

## 7. Authentication & Authorization Model

### 7.1 Two Separate Auth Domains

**Users (API clients):**
- Authenticate via email + password
- Receive a JWT access token
- Token is sent on subsequent requests as `Authorization: Bearer <token>`
- Verified users have `email_verified_at` set; unverified users can still use the API but email verification is encouraged
- JWT secret is an env variable (`JWT_SECRET`)
- Token is invalidatable on logout

**Admins (web panel):**
- Authenticate via email + password + must have `verified = 'Y'`
- Session cookie auth
- Two tiers: `Super` and `Sub`
- Super admin can register the first admin (no auth required for that flow)
- All subsequent admin management requires an active verified admin session
- Admins also have an OAuth `accessToken` stored in the DB (generated on admin creation)

### 7.2 Middleware Summary

| Name | Description |
|---|---|
| `auth` (JWT) | Verifies JWT token on incoming request |
| `user` | Verifies the JWT-authenticated entity is a User (not Admin) |
| `isLogged` | Verifies any session-based authentication is active |
| `isAdmin` | Verifies web session is active AND admin's `verified = 'Y'` |
| `guard` | Switches the default auth driver (used for email verification flow) |
| `signed` | Validates cryptographically signed URLs (for email verification) |
| `throttle` | Rate-limits requests |

---

## 8. Email Notifications

### 8.1 Email Verification
Triggered automatically when a new user registers. Sends an email with a signed URL linking to `GET /api/v1/user/email/verify/{id}?signature=...`. The URL expires in 4320 minutes (72 hours). On successful verification, the user is redirected to `{user-domain}/email-verified`.

### 8.2 Password Reset
Triggered by `POST /api/v1/user/password/email`. Sends an email with a link to `{user-domain}/reset-password/{token}`. Token expires in 60 minutes.

Both emails are sent from `no-reply@incharge.com.ng` with sender name `InCharge`.

---

## 9. Algorithm Decision Tree

The algorithm system encodes a contraceptive counselling decision tree. Here is how it works conceptually:

1. A client app fetches the active algorithm steps (`GET /algo` filtered to `active = 'Y'`).
2. The app presents steps to the user in order, starting from the step with the lowest `delay` value.
3. Each step has a `text` (the question/statement) and an `actionType`:
   - `bool` — the user answers yes/no (labels in `positive`/`negative` fields)
   - `input` — the user types a free-text or numeric input
   - `date` — the user picks a date
   - `null` — informational only; proceed directly to `nextMove`
4. Navigation:
   - If the step branches on the user's answer: use `onPositive` or `onNegative` IDs as the next step
   - Otherwise: use `nextMove` as the next step
5. Conditional evaluation: Before presenting a step, the client may evaluate `conditionalFactor` (a profile field key) against `conditionalValue` using `conditionalOperator`. If the condition is not met, the step may be skipped.
6. Temp plan: `tempPlan`, `tempPlanDirP`, `tempPlanDirN` suggest a contraceptive plan at various points. The final plan is stored on the user's profile via `POST /api/v1/user/profile/algorithm`.
7. `progestogenPossible` / `progestogenPossibleDir` indicate whether progestogen-only methods are applicable at this step and on which answer branch.
8. `stateValue` is a marker that can be tracked during traversal to influence downstream logic.
9. `series` groups steps that belong to a related sub-sequence.
10. Only steps with `active = 'Y'` are part of the published algorithm.

---

## 10. Response Format Conventions

### Success
```json
{ "status": true, "message": "...", "data": { } }
```
Or for resource collections, a JSON array or paginated wrapper.

### Created
HTTP `201` with `{ "status": "...", "message": "...", "data": { } }`

### Validation Error
HTTP `422`
```json
{ "errors": { "field_name": ["error message"] } }
```

### Auth / Permission Error
HTTP `401`
```json
{ "message": "Permission Denied" }
```
or
```json
{ "error": "You are not allowed to access this resource" }
```

### Server Error
HTTP `500`
```json
{
  "status": false,
  "message": "...",
  "error": "...",
  "trace": "..."
}
```
`error` and `trace` are omitted in production.

### JWT Token Response
HTTP `200`
```json
{ "token": "<jwt_string>" }
```
Plus `Authorization: Bearer <jwt_string>` response header.

### Paginated Response
Standard pagination envelope: `data` array, `current_page`, `per_page`, `total`, `last_page`, `from`, `to`, `first_page_url`, `last_page_url`, `next_page_url`, `prev_page_url`, `path`.

---

## 11. Environment Configuration

| Variable | Description |
|---|---|
| `APP_ENV` | `local` or `production`. Determines whether stack traces are included in error responses. |
| `APP_URL` | The server's base URL |
| `app.api-domain` | Domain for the API (used for route grouping) |
| `app.user-domain` | Frontend app domain (used in email links) |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Database credentials |
| `JWT_SECRET` | Secret for signing JWTs |
| `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION` | SMTP config |
| `QUEUE_CONNECTION` | Currently `sync` (emails sent synchronously) |

---

## 12. Admin Panel Frontend (Vue.js)

The admin panel has three Vue components:
1. **AdminloginComponent** — login form, posts credentials to `/login`
2. **RegistersuperadminComponent** — shown only when no Super admin exists; creates the first admin
3. **AdminComponent** — the main SPA shell after login, served at `/panel`

The panel uses a Materialize CSS design system with Material Icons and Font Awesome.

---

## 13. Non-functional Requirements

- **Soft deletes** on: users, clinics, locations, states, contraception_reasons, faqs, algorithms, admins
- **CORS**: fully open (wildcard) with `Authorization` header exposed
- **API versioning**: current version is `v1`; the route structure is designed to accommodate future versions by subdirectory
- **Relationship eager-loading**: clients can request related data on most list endpoints via `?with=relation1,relation2`. Allowed relationships are defined per endpoint (see above).
- **Geo-distance queries**: The clinic list endpoint supports haversine-formula distance filtering and sorting using the client-provided lat/lng, radius, and mode
- **Searching**: Clinic and profile queries support a `?search=` parameter that performs a case-insensitive LIKE search across multiple fields (including related table fields via subqueries)
- **Sorting**: Clinic queries support multi-column sort via `?sort=col1|dir,col2|dir`
- **Pagination**: Controlled by `?page=` and `?per_page=` query params; defaults vary (20 for clinics API, 50 for admin lists)
- **Password reset token expiry**: 60 minutes
- **Email verification link expiry**: 4320 minutes (72 hours)
- **API rate limit**: 120 requests/minute/IP globally; 6 requests/minute on email verify/resend endpoints
