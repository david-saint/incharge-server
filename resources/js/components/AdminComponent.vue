<template>
    <div>
        <ul id="adminDropdown" class="dropdown-content">
            <li><a href="/logout">Logout</a></li>
        </ul>
        <nav class="nav-extended">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Incharge Server</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="dropdown-trigger" href="#!" data-target="adminDropdown">{{adminNames}}<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
                <div class="nav-content">
                    <ul class="tabs tabs-transparent">
                        <li class="tab"><a class="active" href="#users">Users</a></li>
                        <li class="tab"><a href="#clinics">Clinics</a></li>
                        <li class="tab"><a href="#algo">Algorithm</a></li>
                        <li class="tab" v-show="adminUserType == 'Super'"><a href="#admin">Admin</a></li>
                    </ul>
                </div>
            </div>            
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li><a href="#">Admin Panel</a></li>
        </ul>
        <div id="banner">
            
        </div>
        
        <div class="container" id="panelData">
            
            <div class="row">                
                <div id="users" class="col s12">
                    <h2>Users</h2>
                    <div class="center-align" v-if="dataReady">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="row mainData">
                            <div class="col l12 m12 s12 borderedUD">
                                <a href="#" data-target="showDeletedUserModal" class="waves-effect waves-light btn-flat modal-trigger right" @click="getDeletedUsers()">
                                    <i class="material-icons left">refresh</i>Reactivate Users
                                </a>
                            </div> 
                            <div class="col l12 m12 s12">
                                <table class="highlight responsive-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Names</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-if="users.length < 1">
                                            <td colspan="6" class="center-align">
                                                <small><i>No User.</i></small>
                                            </td>
                                        </tr>
                                        <tr v-else v-for="(user, index) in users" :key="user.id">
                                            <td>{{index + 1}}</td>
                                            <td>{{user.name}}</td>
                                            <td>{{user.profile.age}}</td>
                                            <td>{{user.profile.gender}}</td>
                                            <td>{{user.phone}}</td>
                                            <td>
                                                <a href="#" @click="showUserDetails(user.id, $event)"><i class="material-icons">visibility</i></a>
                                                
                                                <a href="#" data-target="delUserModal" class="red-text modal-trigger" @click="delUserDetails(user.id)"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col l12 m12 s12">
                                <span v-if="pagination.currentPage == 1">
                                    <a class="waves-effect waves-light btn-small purple darken-3" disabled>Prev</a>
                                </span>
                                <span v-else>
                                    <a class="waves-effect waves-light btn-small purple darken-3" @click="getPageData(pagination.firstPage)">First</a>
                                    <a class="waves-effect waves-light btn-small purple darken-3" @click="getPageData(pagination.currentPage - 1)">Prev</a>
                                </span>
                                
                                <a class="waves-effect waves-light btn-small btn-flat" @click="getPageData(index)" v-for="index in pagination.lastPage" :key="index">{{index}}</a>

                                <span v-if="pagination.currentPage == pagination.lastPage">
                                
                                    <a class="waves-effect waves-light btn-small purple darken-3" disabled>Last</a>
                                </span>
                                <span v-else>
                                    <a class="waves-effect waves-light btn-small purple darken-3" @click="getPageData(pagination.currentPage + 1)">Next</a>
                                    <a class="waves-effect waves-light btn-small purple darken-3" @click="getPageData(pagination.lastPage)">Last</a>
                                </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div id="clinics" class="col s12">
                    <h2>Clinics</h2>
                    <div class="row mainData">
                        <div class="col l12 m12 s12 borderedUD">
                            <a href="#" data-target="showAddClinicModal" class="blue-text waves-effect waves-light btn-flat modal-trigger" @click="showAddClinicModal()">
                                <i class="material-icons left">add</i>Add Clinic
                            </a>
                            <a href="#" data-target="showDeletedClinicModal" class="blue-text waves-effect waves-light btn-flat modal-trigger right" @click="getDeletedClinics()">
                                <i class="material-icons left">refresh</i>Reactivate Clinics
                            </a>
                        </div> 
                        <div class="col l12 m12 s12">
                            <table class="highlight responsive-table">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="clinics.length < 1">
                                        <td colspan="6" class="center-align">
                                            <small><i>No Clinic.</i></small>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(clinic, index) in clinics" :key="clinic.id">
                                        <td>{{index + 1}}</td>
                                        <td>{{clinic.name}}</td>
                                        <td>{{clinic.longitude}}</td>
                                        <td>{{clinic.latitude}}</td>
                                        <td>{{clinic.address}}</td>
                                        <td>
                                            <a href="" data-target="showMapModal" class="modal-trigger tooltipped" data-position="bottom" data-tooltip="Show Clinic on Map" @click="showMapModal(clinic.id)"><i class="material-icons">visibility</i></a>
                                            <a href="" data-target="showEditClinicModal" class="grey-text modal-trigger" @click="showEditClinicModal(clinic.id)"><i class="material-icons">edit</i></a>
                                            <a href="#" data-target="delClinicModal" class="red-text modal-trigger" @click="delClinicDetails(clinic.id)"><i class="material-icons">delete</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col l12 m12 s12">
                            <span v-if="clinicPagination.currentPage == 1">
                                <a class="waves-effect waves-light btn-small purple darken-3" disabled>Prev</a>
                            </span>
                            <span v-else>
                                <a class="waves-effect waves-light btn-small purple darken-3" @click="getClinicPageData(clinicPagination.firstPage)">First</a>
                                <a class="waves-effect waves-light btn-small purple darken-3" @click="getClinicPageData(clinicPagination.currentPage - 1)">Prev</a>
                            </span>
                            
                            <a class="waves-effect waves-light btn-small btn-flat" @click="getClinicPageData(index)" v-for="index in clinicPagination.lastPage" :key="index">{{index}}</a>

                            <span v-if="clinicPagination.currentPage == clinicPagination.lastPage">
                                <!-- <a class="waves-effect waves-light btn-small purple darken-3" disabled>Next</a> -->
                                <a class="waves-effect waves-light btn-small purple darken-3" disabled>Last</a>
                            </span>
                            <span v-else>
                                <a class="waves-effect waves-light btn-small purple darken-3" @click="getClinicPageData(clinicPagination.currentPage + 1)">Next</a>
                                <a class="waves-effect waves-light btn-small purple darken-3" @click="getClinicPageData(clinicPagination.lastPage)">Last</a>
                            </span>
                        </div>
                        
                    </div>
                </div>
                <div id="algo" class="col s12">
                    <h2>Algorithm</h2>
                    <div class="row">
                        <div class="col l12 m12 s12 borderedUD">
                            <a href="#" data-target="showAddAlgoModal" class="blue-text waves-effect waves-light btn-flat modal-trigger" @click="showAddAlgoModal()">
                                <i class="material-icons left">add</i>Add Algo
                            </a>
                            <a href="#" data-target="showDeletedAlgoModal" class="blue-text waves-effect waves-light btn-flat modal-trigger right" @click="getDeletedAlgos()">
                                <i class="material-icons left">refresh</i>Reactivate Algo
                            </a>
                        </div>
                        <div class="col l12 m12 s12">
                            <table class="highlight responsive-table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Active</th>
                                    <th>Text</th>
                                    <th>Condition</th>
                                    <th>Action Type</th>
                                    <th>Positive</th>
                                    <th>Negative</th>
                                    <th>onPositive</th>
                                    <th>onNegative</th>
                                    <th>Next Move</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr v-if="clinics.length < 1">
                                        <td colspan="9" class="center-align">
                                            <small><i>No Algorithm.</i></small>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="alg in algos" :key="alg.id">
                                        <td>{{alg.id}}</td>
                                        <td>
                                            <label v-if="alg.active == 'true'">
                                                <input type="checkbox" checked @change="toggleActive(alg.id, $event)"/>
                                                <span></span>
                                            </label>
                                            <label v-else>
                                                <input type="checkbox" @change="toggleActive(alg.id, $event)"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>{{alg.text}}</td>
                                        <td>{{alg.conditionalFactor}} {{alg.conditionalOperator}} {{alg.conditionalValue}}</td>
                                        <td>{{alg.actionType}}</td>
                                        <td>{{alg.positive}}</td>
                                        <td>{{alg.negative}}</td>
                                        <td class="center-align">{{alg.onPositive}}</td>
                                        <td class="center-align">{{alg.onNegative}}</td>
                                        <td>{{alg.nextMove}}</td>
                                        <td>
                                            <a href="" data-target="showAlgoModal" class="modal-trigger" @click="showAlgoModal(alg.id)"><i class="material-icons">visibility</i></a>
                                            <!-- <a href="" data-target="showEditClinicModal" class="grey-text modal-trigger" @click="showEditClinicModal(clinic.id)"><i class="material-icons">edit</i></a>
                                            <a href="#" data-target="delClinicModal" class="red-text modal-trigger" @click="delClinicDetails(clinic.id)"><i class="material-icons">delete</i></a> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <span v-show="adminUserType == 'Super'">
                    <div id="admin" class="col s12">
                        <h2>Admin</h2>
                        <div class="row">
                            <div class="col l12 m12 s12 borderedUD">
                                <a href="#" data-target="showAddAdminModal" class="blue-text waves-effect waves-light btn-flat modal-trigger" @click="showAddAdminModal()">
                                    <i class="material-icons left">add</i>Add Admin
                                </a>
                                <!-- <a href="#" data-target="showDeletedAdmin" class="blue-text waves-effect waves-light btn-flat modal-trigger right" @click="getDeletedAdmins()">
                                    <i class="material-icons left">refresh</i>Reactivate Admin
                                </a> -->
                            </div>
                            <div class="col l12 m12 s12">
                                <table class="highlight responsive-table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Active</th>
                                        <th>Names</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <div class="progress" v-show="adminVerifyAction">
                                        <div class="indeterminate"></div>
                                    </div>
                                    <tbody>
                                        <tr v-if="admins.length < 1">
                                            <td colspan="9" class="center-align">
                                                <small><i>No Admin Account.</i></small>
                                            </td>
                                        </tr>
                                        <tr v-else v-for="(admin, index) in admins" :key="admin.id">
                                            
                                            <td>{{index + 1}}</td>
                                            <td>
                                                <span v-if="admin.userType == 'Super'">
                                                    Super User
                                                </span>
                                                <span v-else>
                                                    <label v-if="admin.verified == 'Y'">
                                                        <input type="checkbox" checked @change="toggleVerified(admin.id, $event)"/>
                                                        <span></span>
                                                    </label>
                                                    <label v-else>
                                                        <input type="checkbox" @change="toggleVerified(admin.id, $event)"/>
                                                        <span></span>
                                                    </label>
                                                </span>                                                
                                            </td>
                                            <td>{{admin.firstname}} {{admin.lastname}}</td>
                                            <td>{{admin.email}}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </span>
                
            </div>            
        </div>   

        <!-- USER MODAL -->
        <div id="showUserModal" class="modal">
            <div class="modal-content">
                <div class="center-align" v-if="!userDetailReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    <h4>{{user.name}}</h4>
                    <div class="row">
                        <div class="col l3 m6 s6">
                            <b>Gender:</b> <br>{{user['profile']['gender']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Age:</b> <br>{{user['profile']['age']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Phone:</b> <br>{{user.phone}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Email:</b> <br>{{user.email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l6 m6 s6">
                            <b>Address:</b> <br>{{user['profile']['address']}}
                        </div>
                        <div class="col l6 m6 s6">
                            <b>Educational Level:</b> <br>{{user['profile']['education_level']['name']}}
                            
                        </div>
                    </div>
                     <div class="row">
                        <div class="col l3 m6 s6">
                            <b>Marital:</b> <br>{{user['profile']['marital_status']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Sexual:</b> <br>{{user['profile']['sexually_active']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Height:</b> <br>{{user['profile']['height']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Weight:</b> <br>{{user['profile']['weight']}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l3 m6 s6">
                            <b>Religion:</b> <br>{{user['profile']['religion']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Sect:</b> <br>{{user['profile']['religion_sect']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Children:</b> <br>{{user['profile']['number_of_children']}}
                        </div>
                        <div class="col l3 m6 s6">
                            <b>Occupation:</b> <br>{{user['profile']['occupation']}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l4 m6 s6">
                            <b>Pregnant:</b> <br>{{user['profile']['pregnancy_status']}}
                        </div>
                        <div class="col l4 m6 s6">     
                            <b>Contraceptive Plan:</b> <br>{{user['profile']['meta']['contraceptive_plan']}}
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div id="delUserModal" class="modal">
            <div class="modal-content">
                <div class="center-align" v-if="user.length < 1 || deleteUserReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    
                    <div class="center-align">
                        <h4>{{user.name}}</h4>
                        <p>You sure you need to delete this user's account?</p>
                        <a class="waves-effect waves-light btn-small btn-flat modal-close">No</a> 
                        <a class="waves-effect waves-light btn-small btn-flat red" @click="deleteUser(user.id)">Yes</a>
                    </div>
                    
                    <p class="yellow center-align"><small><i>Deleting an account makes the user inactive but his/her records are still intact incase of a reactivation.</i></small></p>
                </div>
            </div>
        </div>     
        <div id="showDeletedUserModal" class="modal">
            <div class="modal-content">
                <h4>Deleted Users</h4>
                <div class="center-align" v-if="deletedUsersData || updateUserReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    <table class="highlight responsive-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Names</th>
                            <th>Activate</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-if="deletedUsers.length < 1">
                                <td colspan="6" class="center-align">
                                    <small><i>No Deleted User.</i></small>
                                </td>
                            </tr>
                            <tr v-else v-for="(user, index) in deletedUsers" :key="user.id">
                                <td>{{index + 1}}</td>
                                <td>{{user.name}}</td>
                                <td>
                                    <a href="#" @click="revertUser(user.id)"><i class="material-icons">refresh</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- CLINIC MODALS -->
        <div id="showAddClinicModal" class="modal">
            <div class="modal-content">
                <h4>Add Clinic</h4>
                <div class="row">
                    <form class="col s12" @submit="addClinicOp($event)" method="POST">
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input id="clinic_name" type="text" class="validate" v-model="addClinic.name">
                                <label for="clinic_name">Clinic Name</label>
                            </div>
                            <div class="input-field col s12 m12 l12">
                                <input id="address" type="text" class="validate" v-model="addClinic.address">
                                <label for="address">Clinic Address</label>
                            </div>
                            <div>
                                <input type="hidden" v-model="addClinic.longitude" name="longitude" id="longitude" class="validate">
                                <input type="hidden" v-model="addClinic.latitude" name="latitude" id="latitude" class="validate">
                            </div>
                            <div id="mapDiv" class="input-field col s12 m12 l12"></div>
                            <div class="col l12 m12 s12 yellow center-align gutterBtm" v-html="addClinicFeedback"></div>
                            <div class="col s12 m12 l12 center-align">
                                <span v-if="addClinic.name == '' || addClinic.address == ''">
                                    <button class="btn waves-effect waves-light" disabled>Add
                                        <i class="material-icons right">add</i>
                                    </button>
                                </span>
                                <span v-else>
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Add
                                        <i class="material-icons right">add</i>
                                    </button>
                                </span>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
        <div id="showEditClinicModal" class="modal">
            <div class="modal-content">
                <h4>Edit Clinic</h4>
                <div class="center-align" v-if="updateClinicReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div class="row" v-else>
                    <form class="col s12" @submit="editClinicOp($event)" method="POST">
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input id="clinic_name" type="text" class="validate" v-model="clinic.name">
                                <!-- <label for="clinic_name">Clinic Name</label> -->
                            </div>
                            <div class="input-field col s12 m12 l12">
                                <input id="address" type="text" class="validate" v-model="clinic.address">
                                <!-- <label for="address">Clinic Address</label> -->
                            </div>
                            <div>
                                <input type="hidden" v-model="clinic.longitude" name="longitude" id="longitude" class="validate">
                                <input type="hidden" v-model="clinic.latitude" name="latitude" id="latitude" class="validate">
                            </div>
                            <div id="editMapDiv" class="input-field col s12 m12 l12"></div>
                            <div class="col l12 m12 s12 yellow center-align gutterBtm" v-html="addClinicFeedback"></div>
                            <div class="col s12 m12 l12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Edit
                                    <i class="material-icons right">edit</i>
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="showMapModal" class="modal">
            <div class="modal-content">
                <h4>{{clinic.name}}</h4>
                <p><b>Address: </b>{{clinic.address}}</p>
                <div id="clinicMap"></div>
            </div>
        </div>
        <div id="delClinicModal" class="modal">
            <div class="modal-content">
                <div class="center-align" v-if="clinic.length < 1 || deleteClinicReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    
                    <div class="center-align">
                        <h4>{{clinic.name}}</h4>
                        <p>You sure you need to delete this clinic?</p>
                        <a class="waves-effect waves-light btn-small btn-flat modal-close">No</a> 
                        <a class="waves-effect waves-light btn-small btn-flat red" @click="deleteClinic(clinic.id)">Yes</a>
                    </div>
                    
                    <p class="yellow center-align"><small><i>Deleting a clinic makes the clinic inactive but its records are still intact incase of a reactivation.</i></small></p>
                </div>
            </div>
        </div>
        <div id="showDeletedClinicModal" class="modal">
            <div class="modal-content">
                <h4>Deleted Clinics</h4>
                <div class="center-align" v-if="deletedClinicsData || updateClinicReady">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    <table class="highlight responsive-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Names</th>
                            <th>Activate</th>
                        </tr>
                        </thead>

                        <tbody>
                            <tr v-if="deletedClinics.length < 1">
                                <td colspan="6" class="center-align">
                                    <small><i>No Deleted Clinic.</i></small>
                                </td>
                            </tr>
                            <tr v-else v-for="(clinic, index) in deletedClinics" :key="clinic.id">
                                <td>{{index + 1}}</td>
                                <td>{{clinic.name}}</td>
                                <td>
                                    <a href="#" @click="revertClinic(clinic.id)"><i class="material-icons">refresh</i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ALGO MODAL -->
        <div id="showAddAlgoModal" class="modal">
            <div class="modal-content">
                <h4 class="center-align">Add Algorithm</h4>
                <div class="row">
                    <h5 class="col s12">Form</h5>
                        <form class="col s12" @submit="addAlgoOp($event)" method="POST">
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <select v-model="addAlgo.actionType">
                                    <option value="" disabled selected>Choose Action Type</option>
                                    <option value="bool">Boolean (Y/N)</option>
                                    <option value="input">Text Input</option>
                                    <option value="date">Date Picker</option>
                                    <option value="_">Conditional</option>
                                    <option value="next">No Action (Next)</option>
                                </select>
                                <label>What type of action is required?</label>
                            </div>
                        </div>   
                        <div v-if="addAlgo.actionType && addAlgo.actionType == '_'" class="row">
                            <div class="col s4 m4 l4">
                                <select @change="clearConditionalValue()" v-model="addAlgo.conditionalFactor" class="browser-default">
                                    <option value="" selected>Choose Factor</option>
                                    <option value="age">Age</option>
                                    <option value="gender">Gender</option>
                                    <option value="marital_status">Marital Status</option>
                                    <option value="height">Height</option>
                                    <option value="weight">Weight</option>
                                    <option value="education_level_id">Educational Level</option>
                                    <option value="number_of_children">Number of CHildren</option>                                            
                                    <option value="contraception_reason_id">Contraception Reason</option>
                                    <option value="sexually_active">Sexually Active</option>
                                    <option value="pregnancy_status">Pregnancy Status</option>
                                    <option value="religion">Religion</option>
                                    <option value="religion_sect">Religion Sect</option>
                                </select>
                                <label>Conditional Factor</label>
                            </div>

                            <div class="col s4 m4 l4">
                                <select class="browser-default" v-model="addAlgo.conditionalOperator">
                                    <option value="" selected>Choose Operator</option>
                                    <option value=">" v-if="addAlgo.conditionalFactor != 'education_level_id' && addAlgo.conditionalFactor != 'contraception_reason_id' && addAlgo.conditionalFactor != 'marital_status' && addAlgo.conditionalFactor != 'gender' && addAlgo.conditionalFactor != 'religion' && addAlgo.conditionalFactor != 'religion_sect' && addAlgo.conditionalFactor != 'pregnancy_status'">&gt;</option>
                                    <option value="<" v-if="addAlgo.conditionalFactor != 'education_level_id' && addAlgo.conditionalFactor != 'contraception_reason_id' && addAlgo.conditionalFactor != 'marital_status' && addAlgo.conditionalFactor != 'gender' && addAlgo.conditionalFactor != 'religion' && addAlgo.conditionalFactor != 'religion_sect' && addAlgo.conditionalFactor != 'pregnancy_status'">&lt;</option>
                                    <option value=">=" v-if="addAlgo.conditionalFactor != 'education_level_id' && addAlgo.conditionalFactor != 'contraception_reason_id' && addAlgo.conditionalFactor != 'marital_status' && addAlgo.conditionalFactor != 'gender' && addAlgo.conditionalFactor != 'religion' && addAlgo.conditionalFactor != 'religion_sect' && addAlgo.conditionalFactor != 'pregnancy_status'">&ge;</option>
                                    <option value="<=" v-if="addAlgo.conditionalFactor != 'education_level_id' && addAlgo.conditionalFactor != 'contraception_reason_id' && addAlgo.conditionalFactor != 'marital_status' && addAlgo.conditionalFactor != 'gender' && addAlgo.conditionalFactor != 'religion' && addAlgo.conditionalFactor != 'religion_sect' && addAlgo.conditionalFactor != 'pregnancy_status'">&le;</option>
                                    <option value="!=">&#8800;</option>
                                    <option value="=">&#61;</option> 
                                </select>
                                <label>Conditional Operator</label>
                            </div>
                            <div class="col s4 l4 m4" v-if="addAlgo.conditionalFactor && addAlgo.conditionalFactor != 'education_level_id' && addAlgo.conditionalFactor != 'contraception_reason_id' && addAlgo.conditionalFactor != 'marital_status' && addAlgo.conditionalFactor != 'gender' && addAlgo.conditionalFactor != 'religion' && addAlgo.conditionalFactor != 'religion_sect' && addAlgo.conditionalFactor != 'pregnancy_status'">
                                
                                <input v-model="addAlgo.conditionalValue" placeholder="Value to compare against the factor" id="conditionalValue" type="text" class="validate">
                                <label for="first_name">Condition value</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'education_level_id'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Educational Level</option>
                                    <option v-for="ed in eduLevel" :key="ed.id" v-bind:option="ed.id">{{ed.name}}</option> 
                                </select>
                                <label>Choose Educational Level</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'contraception_reason_id'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Contraception Reason</option>
                                    <option v-for="contra in contraceptiveReason" :key="contra.id" v-bind:option="contra.id">{{contra.value}}</option> 
                                </select>
                                <label>Choose Contraception Reason</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'marital_status'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Choose Marital Status</option>
                                    <option value="SINGLE">Single</option>
                                    <option value="RELATIONSHIP">Relationship</option>
                                </select>
                                <label>Choose Marital Status</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'gender'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Choose Gender</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                                <label>Choose Gender</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'religion'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Choose Religion</option>
                                    <option value="CHRISTIANITY">Christianity</option>
                                    <option value="ISLAM">Islam</option>
                                    <option value="OTHER">Other</option>
                                </select>
                                <label>Choose Religion</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'religion_sect'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Choose Christian Sect</option>
                                    <option value="CATHOLIC">Catholic</option>
                                    <option value="PENTECOSTAL">Pentecostal</option>
                                    <option value="OTHER">Other</option>
                                </select>
                                <label>Choose Christian Sect</label>
                            </div>
                            <div class="col s4 m4 l4" v-if="addAlgo.conditionalFactor == 'pregnancy_status'">
                                <select class="browser-default" v-model="addAlgo.conditionalValue">
                                    <option value="" selected>Choose Pregnancy Status</option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                                <label>Choose Pregnancy Status</label>
                            </div>
                        </div>
                        <div v-if="addAlgo.actionType && addAlgo.actionType != '_'">
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                    <textarea placeholder="Question/Direction for this algorithm slide" id="textarea1" v-model="addAlgo.text" class="materialize-textarea"></textarea>
                                    <label for="clinic_name">Algo Text</label>
                                </div>
                                
                                <div class="input-field col s6 m6 l6">
                                    <input placeholder="Time spent in displaying the text. 1sec = 1000, 2sec = 2000,..." id="delay" type="number" class="validate" v-model="addAlgo.delay">
                                    <label for="delay">Delay</label>
                                </div>

                                <div class="col s12 m12 l12">
                                    <select class="browser-default" v-model="addAlgo.tempPlan">
                                        <option value="" selected>Choose a Temp Plan</option>
                                        <option value="WITHDRAWAL_METHOD">Withdrawal Method</option>
                                        <option value="FERTILE_PERIOD_MONITOR">Fertile Period Monitor</option>
                                        <option value="MALE_BARRIER">Male Barrier</option>
                                        <option value="MALE_VASECTOMY">Male Vasectomy</option>
                                        <option value="COMBINED_ORAL">Combined Oral</option>
                                        <option value="PROGESTOGEN_ONLY">Pregestogen Only</option>
                                        <option value="COMBINED_PATCHES">Combined Patches</option>
                                    </select>
                                    <label>Temp Plan (Optional)</label>
                                </div>
                            </div>                                    

                            <div v-if="addAlgo.actionType == 'bool'" class="row">
                                <div class="input-field col s6 m6 l6">
                                    <input placeholder="Text displayed on button for positive response (only for boolean)" id="positive" type="text" class="validate" v-model="addAlgo.positive">
                                    <label for="positive">Positive</label>
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    <input placeholder="Text displayed on button for negative response (only for boolean)" id="negative" type="text" class="validate" v-model="addAlgo.negative">
                                    <label for="negative">Negative</label>
                                </div>
                            </div>

                            <div v-if="addAlgo.actionType == 'input' || addAlgo.actionType == 'date'" class="row">
                                <div class="col s12 m12 l12">
                                    <select class="browser-default" v-model="addAlgo.stateValue">
                                        <option value="" selected>Choose App State Value</option>
                                        <option value="cycleLength">Menstrual Cycle Length</option>
                                        <option value="periodLength">Menstrual Period Length</option>
                                        <option value="lastPeriodAt">Menstrual Cycle Started</option>
                                    </select>
                                    <label>App State Value</label>
                                </div>
                            </div>
                            <div v-if="addAlgo.actionType == 'date'" class="row">
                            </div>
                        </div>
                        <div class="col s12 m12 l12 center-align">
                            <span v-if="!addAlgo.actionType">
                                <button class="btn waves-effect waves-light" disabled>Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </span>
                            <span v-else>
                                <button class="btn waves-effect waves-light" type="submit" name="action">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </span>                                
                        </div>
                        
                    </form>
                    <!-- <div class="col l4 m12 s12">
                        <h5 class="col s12">Preview</h5>
                        <p v-if="!addAlgo.text" class="center-align">
                            <small class="grey-text"><i>Fill the add algorithm form to preview here.</i></small>
                        </p>
                        <div class="col s12" v-else>
                            <div v-html="addAlgo.text"></div>

                            <div v-if="addAlgo.actionType == 'bool'" class="center-align">
                                <button class="btn-flat">{{addAlgo.positive}}</button>
                                <button class="btn-flat">{{addAlgo.negative}}</button>
                            </div>                            
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div id="showAlgoModal" class="modal">
            <div class="modal-content">
                <div class="center-align" v-if="algo.length < 1">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                <div v-else>
                    <!-- <h4>Algorithm Step</h4> -->
                    <div class="row">
                        <div v-if="algo.text == 'Empty'">
                            <div class="col l12 m12 s12" >
                                <h4 class="center-align">Conditional Step</h4>
                                Where {{algo.conditionalFactor}} {{algo.conditionalOperator}} {{algo.conditionalValue}}
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <p><b>If yes: </b></p>
                                    <select class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.onPositive" @change="updateAlog(algo.id, 1)">
                                        <option value="">Choose next algorithm step</option>
                                        <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                        
                                    </select>
                                </div>
                                <div v-if="algo.conditionalFactor == 'pregnancy_status'">
                                    <select class="browser-default" v-model="editAlgo.progestogenPossibleP" @change="updateAlog(algo.id, 4)">
                                        <option value="" selected>Progestogen Possible</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <label>Progestogen Possible</label>
                                </div>
                            </div>
                            <div class="col l6 m6 s12">
                                <div class="input-field">
                                    <p><b>If no: </b> </p> 
                                    <select class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.onNegative" @change="updateAlog(algo.id, 2)">
                                        <option value="">Choose next algorithm step</option>
                                        <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                        
                                    </select>
                                </div>
                                <div v-if="algo.conditionalFactor == 'pregnancy_status'">
                                    <select class="browser-default" v-model="editAlgo.progestogenPossibleN" @change="updateAlog(algo.id, 4)">
                                        <option value="" selected>Progestogen Possible</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                    <label>Progestogen Possible</label>
                                </div>
                            </div>
                        </div>
                        <div v-if="algo.actionType == 'bool'">
                            <div class="col l12 m12 s12">
                                <h4 class="center-align">Boolean Step (Yes/No)</h4>
                                <div v-html="algo.text"></div>
                                <div class="row">
                                    <div class="col l6 m12 s12">
                                        <h5>Action Buttons</h5>
                                    </div>
                                    <div class="col l6 m12 s12">
                                        <div class="col l6 m6 s12">
                                            <p><b>Positive: </b></p>
                                            <input placeholder="Placeholder" v-model="editAlgo.positive" type="text" class="validate">
                                        </div>
                                        <div class="col l6 m6 s12">
                                            <p><b>Negative: </b></p>
                                            <input placeholder="Placeholder" v-model="editAlgo.negative" type="text" class="validate">
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col l6 m6 s12">
                                        <div class="input-field">
                                            <p><b>On Positive: </b></p>
                                            <select class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.onPositive" @change="updateAlog(algo.id, 1)">
                                                <option value="">Choose next algorithm step</option>
                                                <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                                
                                            </select>
                                        </div>
                                        <select class="browser-default" v-model="editAlgo.progestogenPossibleP" @change="updateAlog(algo.id, 4)">
                                            <option value="" selected>Progestogen Possible</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                        <label>Progestogen Possible (optional)</label>

                                        <select class="browser-default" v-model="editAlgo.tempPlanDirP" @change="updateAlog(algo.id, 5)">
                                            <option value="" selected>Choose a Temp Plan</option>
                                            <option value="WITHDRAWAL_METHOD">Withdrawal Method</option>
                                            <option value="FERTILE_PERIOD_MONITOR">Fertile Period Monitor</option>
                                            <option value="MALE_BARRIER">Male Barrier</option>
                                            <option value="MALE_VASECTOMY">Male Vasectomy</option>
                                            <option value="COMBINED_ORAL">Combined Oral</option>
                                            <option value="PROGESTOGEN_ONLY">Pregestogen Only</option>
                                            <option value="COMBINED_PATCHES">Combined Patches</option>
                                        </select>
                                        <label>Temp Plan (Optional)</label>
                                    </div>
                                    <div class="col l6 m6 s12">
                                        <div class="input-field">
                                            <p><b>On Negative: </b> </p> 
                                            <select class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.onNegative" @change="updateAlog(algo.id, 2)">
                                                <option value="">Choose next algorithm step</option>
                                                <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                                
                                            </select>
                                        </div>
                                        <select class="browser-default" v-model="editAlgo.progestogenPossibleN" @change="updateAlog(algo.id, 4)">
                                            <option value="" selected>Progestogen Possible</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                        <label>Progestogen Possible (optional)</label>

                                        <select class="browser-default" v-model="editAlgo.tempPlanDirN" @change="updateAlog(algo.id, 5)">
                                            <option value="" selected>Choose a Temp Plan</option>
                                            <option value="WITHDRAWAL_METHOD">Withdrawal Method</option>
                                            <option value="FERTILE_PERIOD_MONITOR">Fertile Period Monitor</option>
                                            <option value="MALE_BARRIER">Male Barrier</option>
                                            <option value="MALE_VASECTOMY">Male Vasectomy</option>
                                            <option value="COMBINED_ORAL">Combined Oral</option>
                                            <option value="PROGESTOGEN_ONLY">Pregestogen Only</option>
                                            <option value="COMBINED_PATCHES">Combined Patches</option>
                                        </select>
                                        <label>Temp Plan (Optional)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="algo.actionType == null && algo.text != 'Empty'" >
                            <h4 class="center-align">Informative Step</h4>
                            <div v-html="algo.text"></div>
                            <div class="row">
                                <div class="col l6 m12 s12">
                                    <h5>Next Step</h5>
                                </div>
                                <div class="col l6 m12 s12">
                                    <div class="col s12">
                                        <select  style="margin-top: 1vh" class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.nextMove" @change="updateAlog(algo.id, 3)">
                                            <option value="">Choose next algorithm step</option>
                                            <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div v-if="algo.actionType == 'input'">
                            <div class="col l12 m12 s12">
                                <h4 class="center-align">Text Input Step</h4>
                                <div v-html="algo.text"></div>
                                <div class="row">
                                    <div class="col l6 m12 s12">
                                        <h5>Next Step</h5>
                                    </div>
                                    <div class="col l6 m12 s12">
                                        <div class="col s12">
                                            <select  style="margin-top: 1vh" class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.nextMove" @change="updateAlog(algo.id, 3)">
                                                <option value="">Choose next algorithm step</option>
                                                <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div v-if="algo.actionType == 'date'">
                            <div class="col l12 m12 s12">
                                <h4 class="center-align">Date Step</h4>
                                <div v-html="algo.text"></div>
                                <div class="row">
                                    <div class="col l6 m12 s12">
                                        <h5>Next Step</h5>
                                    </div>
                                    <div class="col l6 m12 s12">
                                        <div class="col s12">
                                            <select  style="margin-top: 1vh" class="browser-default" v-bind:disabled="updateAlgoStatus" v-model="editAlgo.nextMove" @change="updateAlog(algo.id, 3)">
                                                <option value="">Choose next algorithm step</option>
                                                <option v-for="alg in algos" :key="alg.id" v-show="alg.id != algo.id" v-bind:value="alg.id">{{alg.id}} - {{alg.text}}</option>
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="center-align" v-if="updateAlgoStatus">
                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!-- ADMIN MODAL -->
        <div id="showAddAdminModal" class="modal">
            <div class="modal-content">
                <h4 class="center-align">Add Admin</h4>
                <div class="row">
                    <form class="col s12" @submit="addAdminOp($event)" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="First Name" v-model="addAdmin.firstname" type="text" class="validate" required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="Last Name" v-model="addAdmin.lastname" type="text" class="validate" required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Phone Number" v-model="addAdmin.phone" type="text" class="validate" required>
                                <label for="first_name">Phone Number</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="E-Mail" v-model="addAdmin.email" type="email" class="validate" required>
                                <label for="last_name">E-Mail</label>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Password" v-model="addAdmin.password" type="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="Confirm Password" v-model="addAdmin.cPassword" type="password" class="validate" required>
                                <label for="password">Confirm Password</label>
                            </div>
                            
                        </div>
                        <div class="col s12 m12 l12 center-align">
                            <div class="progress" v-show="adminAddAction">
                                    <div class="indeterminate"></div>
                                </div>
                            <span v-if="!addAdmin.firstname || !addAdmin.lastname || !addAdmin.phone || !addAdmin.email || !addAdmin.password || !addAdmin.cPassword">
                                <button class="btn waves-effect waves-light" disabled>Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </span>
                            <span v-else>
                                <button class="btn waves-effect waves-light" type="submit" name="action">Add
                                    <i class="material-icons right">add</i>
                                </button>
                            </span>                                
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                apiUrl: 'https://api.incharge.ga/api/v1',//'http://192.168.43.2/api/v1',
                adminNames: '',
                adminId: 0,
                adminUserToken: '',
                adminUserType: '',
                dataReady: false,
                deleteUserReady: false,
                updateUserReady: false,
                updateAlgoStatus: false,
                deleteClinicReady: false,
                updateClinicReady: false,
                adminVerifyAction: false,
                adminAddAction: false,
                userDetailReady: false,
                users: [],
                user: [],
                clinics: [],
                clinic: [],
                admins: [],
                admin: [],
                eduLevel: [],
                contraceptiveReason: [],
                deletedUsers: [],
                deletedClinics: [],
                deletedUsersData: false,
                deletedClinicsData: false,
                pagination: {
                    path: '',
                    currentPage: 0,
                    lastPage: 0,
                    firstPageUrl: '',
                    prevPageUrl: '',
                    nextPageUrl: '',
                    lastPageUrl: '',
                    total: 0,
                    from: 0,
                    to: 0
                },
                clinicPagination: {
                    path: '',
                    currentPage: 0,
                    lastPage: 0,
                    firstPageUrl: '',
                    prevPageUrl: '',
                    nextPageUrl: '',
                    lastPageUrl: '',
                    total: 0,
                    from: 0,
                    to: 0
                },
                adminPagination: {
                    path: '',
                    currentPage: 0,
                    lastPage: 0,
                    firstPageUrl: '',
                    prevPageUrl: '',
                    nextPageUrl: '',
                    lastPageUrl: '',
                    total: 0,
                    from: 0,
                    to: 0
                },
                addClinic: {
                    name: "",
                    address: "",
                    added_by_id: this.adminId,
                    latitude: 0,
                    longitude: 0
                },
                addClinicFeedback: '<small>Your current location will be saved as this clinics location. Please if it is not, locate it on the map above.</small>',
                addAlgo: {},
                addAdmin: {},
                algos: [],
                algo: [],
                editAlgo: {
                    onPositive: "",
                    onNegative: "",
                    positive: '',
                    negative: '',
                    nextMove: ''
                }
            };
        },
        mounted() {
            

            this.getAdminDetails();
            let checkToken = setInterval(() => {
                if (this.adminId) {
                    clearInterval(checkToken);

                    this.getUsers();
                    this.getClinics();
                    this.getAlgo();
                    this.getEduLevel();
                    this.getContraReason();
                    this.getAdmins();
                }
            }, 1000);
            
        },
        methods: {
            getAdminDetails(){
                this.dataReady = true;
                axios.get("/getAdminDet").then(res => {
                    this.adminId = res.data.id;
                    this.adminNames = res.data.firstname+' '+res.data.lastname;
                    this.adminUserToken = res.data.accessToken;
                    this.adminUserType = res.data.userType;
                });
            },
            getUsers(){
                axios.get(this.apiUrl+"/user/users").then(res => {
                    this.users = res.data.data;
                    this.pagination.currentPage = res.data.current_page;
                    this.pagination.lastPage = res.data.last_page;
                    this.pagination.firstPageUrl = res.data.first_page_url;
                    this.pagination.prevPageUrl = res.data.prev_page_url;
                    this.pagination.nextPageUrl = res.data.next_page_url;
                    this.pagination.lastPageUrl = res.data.last_page_url;
                    this.pagination.total = res.data.total;
                    this.pagination.path = res.data.path;
                    this.pagination.from = res.data.from;
                    this.pagination.to = res.data.to;
                });
            },
            getAdmins(){
                // allAdmins
                axios.get("/allAdmins").then(res => {
                    this.admins = res.data.data;
                    
                    this.adminPagination.currentPage = res.data.current_page;
                    this.adminPagination.lastPage = res.data.last_page;
                    this.adminPagination.firstPageUrl = res.data.first_page_url;
                    this.adminPagination.prevPageUrl = res.data.prev_page_url;
                    this.adminPagination.nextPageUrl = res.data.next_page_url;
                    this.adminPagination.lastPageUrl = res.data.last_page_url;
                    this.adminPagination.total = res.data.total;
                    this.adminPagination.path = res.data.path;
                    this.adminPagination.from = res.data.from;
                    this.adminPagination.to = res.data.to;
                });
            },
            getClinics(){
                // this.dataReady = true;
                axios.get(this.apiUrl+"/user/clinics/getClinics").then(res => {
                    this.clinics = res.data.data;
                    this.clinicPagination.currentPage = res.data.current_page;
                    this.clinicPagination.lastPage = res.data.last_page;
                    this.clinicPagination.firstPageUrl = res.data.first_page_url;
                    this.clinicPagination.prevPageUrl = res.data.prev_page_url;
                    this.clinicPagination.nextPageUrl = res.data.next_page_url;
                    this.clinicPagination.lastPageUrl = res.data.last_page_url;
                    this.clinicPagination.total = res.data.total;
                    this.clinicPagination.path = res.data.path;
                    this.clinicPagination.from = res.data.from;
                    this.clinicPagination.to = res.data.to;
                    // console.log(res.data);
                    
                });
            },
            getAlgo(){
                axios.get("/algo").then(res => {
                    this.algos = res.data;
                   
                });
            },
            getEduLevel(){
                axios.get(this.apiUrl+"/global/education-levels").then(res => {
                    this.eduLevel = res.data;
                });
            },
            getContraReason(){
                axios.get(this.apiUrl+"/global/contraception-reasons").then(res => {
                    
                    this.contraceptiveReason = res.data;
                    this.dataReady = false;
                });
            },
            showEditClinicModal(id){
                this.findAClinic(id);
                
                if (navigator.geolocation) {
                    
                    // navigator.geolocation.getCurrentPosition((position) => {
                        // console.log(position);
                        let latitude = this.clinic.latitude;
                        let longitude = this.clinic.longitude;
                        
                        let marker;

                        let myLatlng = new google.maps.LatLng(latitude,longitude);
                        let myOptions = {
                            zoom: 15,
                            center: myLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        const map = new google.maps.Map(document.getElementById("editMapDiv"), myOptions);
                        // marker refers to a global variable
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map,
                            title: "Current Location",
                        });

                        google.maps.event.addListener(map, "click", (event) => {
                            // get lat/lon of click
                            this.clinic.latitude = event.latLng.lat().toFixed(6);
                            this.clinic.longitude = event.latLng.lng().toFixed(6);
                            
                            let clickLatlng = new google.maps.LatLng(this.clinic.latitude,this.clinic.longitude);
                            
                            //Clear Marker
                            marker.setMap(null);

                            marker = new google.maps.Marker({
                                position: clickLatlng,
                                map: map
                            });
                        });
                    // });
                } else {
                    // Browser doesn't support Geolocation
                    M.toast({html: "Your browser does not support geolocation!", classes: 'error'});
                }
            },
            showAddClinicModal(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        this.addClinic.latitude = position.coords.latitude.toFixed(6);
                        this.addClinic.longitude = position.coords.longitude.toFixed(6);
                        let marker;

                        let myLatlng = new google.maps.LatLng(this.addClinic.latitude,this.addClinic.longitude);
                        let myOptions = {
                            zoom: 15,
                            center: myLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        const map = new google.maps.Map(document.getElementById("mapDiv"), myOptions);
                        // marker refers to a global variable
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map,
                            title: "Current Location",
                        });

                        google.maps.event.addListener(map, "click", (event) => {
                            // get lat/lon of click
                            this.addClinic.latitude = event.latLng.lat().toFixed(6);
                            this.addClinic.longitude = event.latLng.lng().toFixed(6);
                            
                            let clickLatlng = new google.maps.LatLng(this.addClinic.latitude,this.addClinic.longitude);
                            
                            //Clear Marker
                            marker.setMap(null);

                            marker = new google.maps.Marker({
                                position: clickLatlng,
                                map: map
                            });
                        });
                    });
                } else {
                    // Browser doesn't support Geolocation
                    M.toast({html: "Your browser does not support geolocation!", classes: 'error'});
                }
            },
            showAlgoModal(id){
                this.editAlgo = [];
                this.algo = [];
                let algo = this.algos.filter(function(algo) {
                    return algo.id == id;
                });
                this.algo = algo[0];
                this.editAlgo = this.algo;
            },
            showAddAdminModal(id){
                this.admin = [];
                let admin = this.admins.filter(function(admin) {
                    return admin.id == id;
                });
                this.admin = admin[0];
            },
            updateAlog(algoId, updateType){
                this.updateAlgoStatus = true;
                let data;
                if(updateType == 2){//onNegative
                    data = {
                        onNegative: this.editAlgo.onNegative
                    }
                } else if(updateType == 1) {
                    data = {
                        onPositive: this.editAlgo.onPositive
                    }
                } else if(updateType == 3){
                    data = {
                        nextMove: this.editAlgo.nextMove
                    }
                } else if(updateType == 4){
                    let progestogenPossible, progestogenPossibleDir;
                    if(this.editAlgo.progestogenPossibleP){
                        progestogenPossible = this.editAlgo.progestogenPossibleP;
                        progestogenPossibleDir = 'positive';
                    } else if(this.editAlgo.progestogenPossibleN){
                        progestogenPossible = this.editAlgo.progestogenPossibleN;
                        progestogenPossibleDir = 'negative';
                    }
                    data = {
                        progestogenPossible: progestogenPossible,
                        progestogenPossibleDir: progestogenPossibleDir
                    }
                } else if(updateType == 5){
                    if(this.editAlgo.tempPlanDirP){
                        data = {
                            tempPlanDirP: this.editAlgo.tempPlanDirP
                        }
                    } else if(this.editAlgo.tempPlanDirN){
                        data = {
                            tempPlanDirN: this.editAlgo.tempPlanDirN
                        }
                    }
                }           
                
                this.algoUpdateAPI(algoId, data);
            },
            toggleActive(algoId, e){
                let data;
                if(e.target.checked){
                    data = {
                        active: 'true'
                    }
                } else {
                    data = {
                        active: 'false'
                    }
                }
                this.algoUpdateAPI(algoId, data);
            },
            toggleVerified(adminId, e){
                this.adminVerifyAction = true;
                let data;
                if(e.target.checked){
                    data = {
                        verified: 'Y'
                    }
                } else {
                    data = {
                        verified: 'N'
                    }
                }
                axios.put("/updateAdmin/"+adminId, data).then(res => {
                    if(res.status == 200){
                        M.toast({html: 'Admin verification action complete.'});
                    } else {
                        M.toast({html: 'Admin not verified.', classes: 'error'});
                    }
                    this.adminVerifyAction = false;
                });
            },
            algoUpdateAPI(algoId, data){
                axios.put("/algo/"+algoId, data).then(res => {
                    if(res.status == 200){
                        this.algos.forEach((alg, i) => {
                            if(alg.id == res.data.id){
                                this.algos[i] = res.data
                            }
                        });
                        this.updateAlgoStatus = false;
                        
                        // this.algo = [];
                    } else {
                        M.toast({html: 'Algorithm not edited.', classes: 'error'})
                    }
                });
            },
            editClinicOp(e){
                e.preventDefault();

                this.updateClinicReady = true;

                axios.put(this.apiUrl+"/user/clinics/update/"+this.clinic.id, this.clinic).then(res => {
                    if(res.status == 200){
                        location.reload();
                    } else {
                        M.toast({html: 'Clinic not edited.', classes: 'error'})
                    }
                    this.updateClinicReady = false;
                });
            },
            addClinicOp(e){
                e.preventDefault();
                let config = {
                    headers: { Authorization: "Bearer " + this.adminUserToken }
                };
                this.addClinic.added_by_id = this.adminId;
                axios
                .post(this.apiUrl+"/user/clinics/addClinic", this.addClinic, config)
                .then(res => {
                    
                    if (res.status == 201) {
                       location.reload();
                    } else {
                        M.toast({html: "Clinic not added", classes: 'error'});
                    }
                })
                .catch(err => {
                    console.log(err);
                });
            },
            addAdminOp(e){
                this.adminAddAction = true;
                e.preventDefault();
                let config = {
                    headers: { Authorization: "Bearer " + this.adminUserToken }
                };

                if(this.addAdmin.password != this.addAdmin.cPassword){
                    M.toast({html: "Passwords do not match", classes: 'error'});
                    this.adminAddAction = false;
                } else {
                    this.addAdmin.verified = 'N';
                    this.addAdmin.userType =  'Sub';

                    axios
                    .post("/admin", this.addAdmin, config)
                    .then(res => {                        
                        if (res.status == 200) {
                            location.reload();
                        } else {
                            M.toast({html: "Admin not added", classes: 'error'});
                        }
                        this.adminAddAction = false;
                    })
                    .catch(err => {
                        M.toast({html: "Error! Please ensure you are not trying to create a duplicate admin account. Try again later", classes: 'error'});
                    });
                }
                
            },
            getDeletedUsers(){
                this.deletedUsersData = true;
                axios.get(this.apiUrl+"/user/users/deletedUser").then(res => {
                    this.deletedUsers = res.data;
                    this.deletedUsersData = false;
                });
            },
            getDeletedClinics(){
                this.deletedClinicsData = true;
                axios.get(this.apiUrl+"/user/clinics/deletedClinics").then(res => {
                    this.deletedClinics = res.data;
                    this.deletedClinicsData = false;
                });
            },
            showUserDetails(id){                
                this.user = [];
                let user = this.users.filter(function(user) {
                    return user.id == id;
                });                
                this.user = user[0];
                
                this.userDetailReady = true;
                $('#showUserModal').modal('open');
            },
            delUserDetails(id){
                this.user = [];
                let user = this.users.filter(function(user) {
                    return user.id == id;
                });
                this.user = user[0];
            },
            findAClinic(id){
                this.clinic = [];
                let clinic = this.clinics.filter(function(clinic) {
                    return clinic.id == id;
                });
                this.clinic = clinic[0];
                
            },
            showMapModal(id){
                this.findAClinic(id)

                let myLatlng = new google.maps.LatLng(this.clinic.latitude,this.clinic.longitude);
                let myOptions = {
                    zoom: 15,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                const map = new google.maps.Map(document.getElementById("clinicMap"), myOptions);
                // marker refers to a global variable
                let marker = new google.maps.Marker({
                    position: myLatlng,
                    map,
                    title: this.clinic.name,
                });
            },
            delClinicDetails(id){
                this.findAClinic(id)
            },
            deleteUser(id){
                this.deleteUserReady = true;
                axios.delete(this.apiUrl+"/user/users/deleteUser/"+id).then(res => {
                    if(res.status == 200){
                        location.reload();
                    } else {
                        M.toast({html: 'User not deleted.', classes: 'error'})
                    }
                    this.deleteUserReady = false;
                });
            },
            deleteClinic(id){
                this.deleteClinicReady = true;
                axios.delete(this.apiUrl+"/user/clinics/deleteClinic/"+id).then(res => {
                    if(res.status == 200){
                        location.reload();
                    } else {
                        M.toast({html: 'Clinic not deleted.', classes: 'error'})
                    }
                    this.deleteClinicReady = false;
                });
            },
            revertUser(id){
                this.updateUserReady = true;
                let data = {
                    deleted_at: null
                }
                axios.put(this.apiUrl+"/user/users/update/"+id, data).then(res => {
                    if(res.status == 200){
                        location.reload();
                    } else {
                        M.toast({html: 'User not restored.', classes: 'error'})
                    }
                    this.updateUserReady = false;
                });
            },
            revertClinic(id){
                this.updateClinicReady = true;
                let data = {
                    deleted_at: null
                }
                axios.put(this.apiUrl+"/user/clinics/revertDelete/"+id, data).then(res => {
                    if(res.status == 200){
                        location.reload();
                    } else {
                        M.toast({html: 'Clinic not restored.', classes: 'error'})
                    }
                    this.updateClinicReady = false;
                });
            },
            getPageData(pageNum){
                let url = this.pagination.path+'?page='+pageNum
                this.dataReady = true;
                axios.get(url).then(res => {
                    this.users = res.data.data;
                    this.pagination.currentPage = res.data.current_page;
                    this.pagination.lastPage = res.data.last_page;
                    this.pagination.firstPageUrl = res.data.first_page_url;
                    this.pagination.prevPageUrl = res.data.prev_page_url;
                    this.pagination.nextPageUrl = res.data.next_page_url;
                    this.pagination.lastPageUrl = res.data.last_page_url;
                    this.pagination.total = res.data.total;
                    this.pagination.path = res.data.path;
                    this.pagination.from = res.data.from;
                    this.pagination.to = res.data.to;
                    this.dataReady = false;
                });
            },
            getClinicPageData(pageNum){
                let url = this.clinicPagination.path+'?page='+pageNum
                this.dataReady = true;
                // console.log(url);
                axios.get(url).then(res => {
                    this.clinics = res.data.data;
                    this.clinicPagination.currentPage = res.data.current_page;
                    this.clinicPagination.lastPage = res.data.last_page;
                    this.clinicPagination.firstPageUrl = res.data.first_page_url;
                    this.clinicPagination.prevPageUrl = res.data.prev_page_url;
                    this.clinicPagination.nextPageUrl = res.data.next_page_url;
                    this.clinicPagination.lastPageUrl = res.data.last_page_url;
                    this.clinicPagination.total = res.data.total;
                    this.clinicPagination.path = res.data.path;
                    this.clinicPagination.from = res.data.from;
                    this.clinicPagination.to = res.data.to;
                    this.dataReady = false;
                });
            },
            showAddAlgoModal(){

            },
            getDeletedAlgos(){

            },
            addAlgoOp(e){
                e.preventDefault();

                let config = {
                    headers: { Authorization: "Bearer " + this.adminUserToken }
                };

                if(this.addAlgo.actionType == "_"){
                    this.addAlgo.actionType = " ";
                    this.addAlgo.text = "Empty";
                    this.addAlgo.delay = 0;
                }
                if(this.addAlgo.actionType == "next"){
                    this.addAlgo.actionType = " ";
                }
                if(this.addAlgo.actionType == "input"){
                    if(this.addAlgo.stateValue == "cycleLength"){
                        this.addAlgo.label = 'Cycle Length';
                    } else if(this.addAlgo.stateValue == "periodLength"){
                        this.addAlgo.label = 'Average Period Days';
                    } else {
                        M.toast({html: "Please pick a state value", classes: 'error'});
                    }
                }
                
                axios
                .post("/algo", this.addAlgo, config)
                .then(res => {
                    
                    if (res.status == 201) {
                       location.reload();
                    } else {
                        M.toast({html: "Algorithm not added", classes: 'error'});
                    }
                })
                .catch(err => {
                    console.log(err);
                });
            },
            clearConditionalValue(){
                this.addAlgo.conditionalValue = "";
            }
        }
    };
</script>
