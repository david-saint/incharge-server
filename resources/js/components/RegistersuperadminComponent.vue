<template>
    <div class="row">
        <div class="col l4 offset-l4 m6 offset m3 s10 offset-s1" id="regSuperAdmin">
            <h1 class="center-align">Incharge</h1> 
            <h2 class="center-align">Super Admin</h2> 
            <form class="col s12" @submit="createSuperAdmin($event)" method="POST">
                <div class="row">
                    <div class="input-field col l12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="firstaname" v-model="add.firstname" type="text" class="validate" required>
                        <label for="firstaname">First Name</label>
                    </div>
                    <div class="input-field col l12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="lastname" v-model="add.lastname" type="text" class="validate" required>
                        <label for="lastname">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" v-model="add.email" type="email" class="validate" required>
                    <label for="email">Email</label>
                    </div>
                    <div class="input-field col l12">
                        <i class="material-icons prefix">phone</i>
                        <input id="phone" v-model="add.phone" type="tel" class="validate" required>
                        <label for="phone">Telephone</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" v-model="add.password" type="password" class="validate" required>
                    <label for="password">Password</label>
                    </div>
                    <div class="input-field col l12">
                        <i class="material-icons prefix">lock</i>
                        <input id="cPassword" v-model="add.cPassword" type="password" class="validate" required>
                        <label for="cPassword">Confirm Password</label>
                    </div>
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
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                add: {
                    verified: 'Y',
                    userType: 'Super'
                }
            }
        },
        mounted() {
            M.AutoInit();
        },
        methods: {
            createSuperAdmin(e){
                e.preventDefault();
                if(this.add.password == this.add.cPassword){
                    axios
                    .post("/api/v1/admin", this.add)
                    .then(res => {
                        if(res.data == 200){
                            window.location.replace("/api/v1/admin");
                        } else {
                            M.toast({html: 'Error. Please try again', classes: 'error'});
                        }
                    })
                    .catch(err => {
                        M.toast({html: "Seems you already have an account.", classes: 'error'});
                    });
                } else {
                    M.toast({html: "Passwords must match", classes: 'error'});
                }
                
            }
        }
    };
</script>
