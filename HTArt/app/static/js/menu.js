$(document).ready(function(){
    new Vue({
        el: '#vue-menu-app',
        data: {
            is_logged_in: false,
            username: '',
            is_checking_authentication: true
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
                });
            },
            sendComment: function() {
                var text = $('.comment-text').val();
                if (text.length != 0) {
                    $.ajax({
                        method: "POST",
                        url: "/postComment",
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        data: this.getCommentData(text),
                        async: true,
                        //success: function(response){}.bind(this),
                        error: function(jqXHR, status, error){
                            this.noCommentsInfo = "Wystąpił błąd podczas wysyłania wpisu!";
                        }.bind(this)
                    });
                }
                this.getComments();
                this.inputToShow = undefined;
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