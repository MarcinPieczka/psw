$(document).ready(function(){
    new Vue({
        el: '#vue-menu-app',
        data: {
            is_logged_in: false,
            username: '',
            is_checking_authentication: true,
            showModalBg: false,
            showLoginModal: false,
            showRegisterModal: false,
            showPasswordChangeModal: false,
            modalError: ''
        },
        methods: {
            checkLogin: function(){
                $.ajax({
                    method: "GET",
                    url: "/rest-auth/user/",
                    async: true,
                    success: function(response){
                        if(response !== null && response !== undefined){
                            if(response.username !== undefined){
                                this.username = response.username;
                                this.is_logged_in = true;
                                this.is_checking_authentication = false;
                                console.log(this.username);
                            } else {
                                alert("nima");
                            }
                        }
                        console.log(response);
                    }.bind(this),
                    error: function(jqXHR, status, error){
                        this.username = '';
                        this.is_logged_in = false;
                        this.is_checking_authentication = false;
                    }.bind(this)
                });
            },
            logout: function() {
                $.ajax({
                    method: "POST",
                    url: "/rest-auth/logout/",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({}),
                    headers: {'X-CSRFToken': Cookies.get('csrftoken')},
                    async: true,
                    success: function(response){
                        this.username = '';
                        this.is_logged_in = false;
                    }.bind(this),
                    error: function(jqXHR, status, error){
                        this.noCommentsInfo = "Wystąpił błąd podczas wysyłania wpisu!";
                    }.bind(this)
                });
            },
            login: function() {
                var username = $('#login-username').val()
                var password = $('#login-password').val()
                $.ajax({
                    method: "POST",
                    url: "/rest-auth/login/",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({'username': username, 'password': password}),
                    headers: {'X-CSRFToken': Cookies.get('csrftoken')},
                    async: true,
                    success: function(response){
                        this.closeModals();
                        this.checkLogin();
                    }.bind(this),
                    error: function(jqXHR, status, error){
                        this.modalError = error;
                    }.bind(this)
                });
            },
            register: function() {
                var username = $('#register-username').val()
                var email = $('#register-email').val()
                var password = $('#register-password').val()
                var passwordRepeat = $('#register-password-repeat').val()
                $.ajax({
                    method: "POST",
                    url: "/rest-auth/registration/",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        'username': username,
                        'password1': password,
                        'password2': passwordRepeat,
                        'email': email
                    }),
                    headers: {'X-CSRFToken': Cookies.get('csrftoken')},
                    async: true,
                    success: function(response){
                        this.closeModals();
                        this.checkLogin();
                    }.bind(this),
                    error: function(jqXHR, status, error){
                        this.modalError = error;
                    }.bind(this)
                });
            },
            changePassword: function() {
                var password = $('#chpass-password').val()
                var passwordRepeat = $('#chpass-password-repeat').val()
                $.ajax({
                    method: "POST",
                    url: "/rest-auth/password/change/",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        'new_password1': password,
                        'new_password2': passwordRepeat,
                    }),
                    headers: {'X-CSRFToken': Cookies.get('csrftoken')},
                    async: true,
                    success: function(response){
                        this.closeModals();
                        this.checkLogin();
                    }.bind(this),
                    error: function(jqXHR, status, error){
                        this.modalError = error;
                    }.bind(this)
                });
            },
            startLoginModal: function() {
                this.showModalBg = true;
                this.showLoginModal = true;
            },
            startRegisterModal: function() {
                this.showModalBg = true;
                this.showRegisterModal = true;
            },
            startPasswordChangeModal: function() {
                this.showModalBg = true;
                this.showPasswordChangeModal = true;
            },
            closeModals: function() {
                this.showModalBg = false;
                this.showLoginModal = false;
                this.showRegisterModal = false;
                this.showPasswordChangeModal = false;
                this.modalError = '';
            }
        },
        computed: {
        },
        mounted: function(){
            var $that = this;
            setTimeout(function(){
                $that.checkLogin();
            }, 2000);
        }
    });
});