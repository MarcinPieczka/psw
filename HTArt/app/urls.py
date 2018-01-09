from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.index, name='home-page'),
    url(r'^work-1/$', views.work_1, name='work 1'),
    url(r'^work-2/$', views.work_2, name='work 2'),
    url(r'^work-3/$', views.work_3, name='work 3'),
    url(r'^products/$', views.products, name='products'),
    url(r'^cart/$', views.cart, name='cart'),
    url(r'^api/comments/get/(?P<page_id>\w+)/$', views.get_comments),
    url(r'^api/comments/post/$', views.post_comments),
    url(r'^api/blog_posts/get/(?P<username>\w+)/$', views.get_blog_posts),
    url(r'^api/products/$', views.get_products),
    url(r'^api/categories/$', views.get_categories),
    url(r'^db_setup/$', views.db_setup),
]