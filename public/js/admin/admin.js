new Vue({

    // We want to target the div with an id of 'events'
    el: '#users',

    // Here we can register any values or collections that hold data
    // for the application
    data: {
        user: {
            email: 'email0@blop.fr',
            all: ''
        },
        display: false,
        inactif: false,
        deleted: false
    },

// Anything within the ready function will run when the application loads
    ready: function () {
    },

// Methods we want to use in our application are registered here
    methods: {

        afficherUser: function (e){
            e.preventDefault();
            this.$http.post('deleteuser', {email: this.user.email}).success(function (response) {
                this.user.all = response;
                this.display = true;
            });
        },

        passerInactif: function (e) {
            e.preventDefault();
            this.$http.post('deleteuser', {email: this.user.email}).success(function (response) {
                this.inactif = true;
                this.deleted = false;
            });
        },

        forceDeleteUser: function (e) {
            e.preventDefault();
            this.$http.post('forcedeleteuser', {email: this.user.email}).success(function (response) {
                this.inactif = false;
                this.deleted = true;
            });
        }
    }
});
