from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.index, name='home-page'),
    url(r'^work-1/$', views.work_1, name='work 1'),
    url(r'^work-2/$', views.work_2, name='work 2'),
    url(r'^work-3/$', views.work_3, name='work 3'),
    url(r'^products/$', views.products, name='products'),
    url(r'^cart/$', views.cart, name='cart'),
    url(r'^order_confirmation/(?P<order_id>\w+)/$', views.order_confirmation, name='order confirmation'),
    url(r'^api/order_price/(?P<order_id>\w+)/$', views.get_order_price),
    url(r'^api/products/$', views.get_products),
    url(r'^api/categories/$', views.get_categories),
    url(r'^api/order/$', views.post_order),
    url(r'^db_setup/$', views.db_setup),

    # url's for RSI

    url(r'^api/blog/$', views.blogs),
    url(r'^api/blog/(?P<name>\w+)/$', views.blog),
    url(r'^api/blog/(?P<blog_name>\w+)/post/$', views.blog_posts),
    url(r'^api/blog/(?P<blog_name>\w+)/post/(?P<post_title>\w+)/$', views.blog_post),
    url(r'^api/blog/(?P<blog_name>\w+)/post/(?P<post_title>\w+)/comment/$', views.comments),
    url(r'^api/blog/(?P<blog_name>\w+)/post/(?P<post_title>\w+)/comment/(?P<comment_id>\w+)/$', views.comment),
]