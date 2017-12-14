from django.conf.urls import url
from django.contrib import admin
from django.urls import include
from allauth.account.views import confirm_email as allauthemailconfirmation

urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^rest-auth/', include('rest_auth.urls')),
    url(r'^rest-auth/registration/account-confirm-email/(?P<key>[-:\w]+)',
        allauthemailconfirmation, name="account_confirm_email"),
    url(r'^rest-auth/registration/', include('rest_auth.registration.urls')),

    url(r'', include('app.urls')),
]
