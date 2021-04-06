<template>
    <div class="row">
        <div class="col l4 offset-l4 m6 offset m3 s10 offset-s1">
            <div class="row" id="loginAdmin">
                <h1 class="center-align">Incharge</h1> 
                <h2 class="center-align">Admin Login</h2> 
                <form class="col s12" @submit="loginAdmin($event)" method="POST">
                    
                    <div class="input-field col l12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="email" v-model="login.email" type="text" class="validate" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col l12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" v-model="login.password" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col l12 center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>   
                        </div>
                    </div>
                </form>
            </div>
            <footer class="row center-align">
                <small>&copy; Copyright. InCharge</small>
            </footer>
        </div>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                login: {}
            }
        },
        mounted() {
            M.AutoInit();
        },
        methods: {
            loginAdmin(e){
                e.preventDefault();
                
                axios
                .post("/login", this.login)
                .then(res => {
                    if(res.data == 200){
                        window.location.replace("/panel");
                    } else if(res.data == 501){
                        M.toast({html: 'Invalid Email/Password or unverified account', classes: 'error'});
                    }
                })
                .catch(err => {
                    console.log(err.message);
                });
            }
        }
    };
</script>
