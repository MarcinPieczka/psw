from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.index, name='home-page'),
    url(r'^work-1/$', views.work_1, name='work 1'),
    url(r'^work-2/$', views.work_2, name='work 2'),
    url(r'^work-3/$', views.work_3, name='work 3'),
]