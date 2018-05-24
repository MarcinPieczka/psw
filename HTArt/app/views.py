from django.contrib.auth.models import User, AnonymousUser
from django.core import serializers
from django.shortcuts import render
from django.forms.models import model_to_dict
from rest_framework import status
from rest_framework.decorators import api_view
from rest_framework.response import Response
from random import randint, random, getrandbits
import json

from .models import Comment, BlogPost, Blog

from .models import Product

from .models import Order


def index(request):
    return render(request, 'app/index.html')


def work_1(request):
    return render(request, 'app/work-1.html')


def work_2(request):
    return render(request, 'app/work-2.html')


def work_3(request):
    return render(request, 'app/work-3.html')


def products(request):
    return render(request, 'app/shop.html')


def cart(request):
    return render(request, 'app/cart.html')


def order_confirmation(request, order_id):
    price = Order.objects.get(id=order_id).price
    return render(request, 'app/confirmation.html',
                  context={'price': str('%.2f' % price), 'order_id': order_id})


@api_view()
def get_order_price(request, order_id):
    order = Order.objects.get(id=order_id)
    return Response(order.price, status=status.HTTP_200_OK)


@api_view(['POST'])
def post_order(request):
    data = request.data['data']

    if data['name'] == '' or \
            data['surname'] == '' or \
            data['city'] == '' or \
            data['products'] == [] or \
            data['delivery'] == '' or \
            data['cost'] == '':
        return Response("field error", status=status.HTTP_400_BAD_REQUEST)

    order = Order()
    order.id = hex(getrandbits(64))[2:-1]
    order.name = data['name']
    order.surname = data['surname']
    order.city = data['city']
    order.products = str(data['products'])
    order.delivery = data['delivery'].split()[0]
    order.price = float(data['cost'])
    order.save()

    return Response(order.id, status=status.HTTP_200_OK)


@api_view()
def get_products(request):
    return Response(Product.objects.all().values())


@api_view()
def get_categories(request):
    return Response(('Mug', 'T-Shirt', 'Blouse'))


def db_setup(request):
    products = (
        ('mg1', randint(10, 40) + 0.99, 'Mug'),
        ('mg2', randint(10, 40) + 0.99, 'Mug'),
        ('mg3', randint(10, 40) + 0.99, 'Mug'),
        ('mg4', randint(10, 40) + 0.99, 'Mug'),
        ('mg5', randint(10, 40) + 0.99, 'Mug'),
        ('mg6', randint(10, 40) + 0.99, 'Mug'),
        ('mg7', randint(10, 40) + 0.99, 'Mug'),
        ('mg8', randint(10, 40) + 0.99, 'Mug'),
        ('mg9', randint(10, 40) + 0.99, 'Mug'),
        ('ts1', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts2', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts3', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts4', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts5', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts6', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts7', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts8', randint(10, 40) + 0.99, 'T-Shirt'),
        ('ts9', randint(10, 40) + 0.99, 'T-Shirt'),
        ('sw1', randint(10, 40) + 0.99, 'Blouse'),
        ('sw2', randint(10, 40) + 0.99, 'Blouse'),
        ('sw3', randint(10, 40) + 0.99, 'Blouse'),
        ('sw4', randint(10, 40) + 0.99, 'Blouse'),
        ('sw5', randint(10, 40) + 0.99, 'Blouse'),
        ('sw6', randint(10, 40) + 0.99, 'Blouse'),
        ('sw7', randint(10, 40) + 0.99, 'Blouse'),
        ('sw8', randint(10, 40) + 0.99, 'Blouse'),
        ('sw9', randint(10, 40) + 0.99, 'Blouse'),
    )
    for product in products:
        p = Product()
        p.img_name = product[0]
        p.price = product[1]
        p.category = product[2]
        p.save()
    return render(request, 'app/index.html')

#
# Here starts new code made for RSI labs
#


@api_view(['GET'])
def blogs(request):
    blogs = []
    for blog in Blog.objects.all():
        blogs.append(model_to_dict(blog))
    return Response(blogs)


@api_view(['GET', 'POST', 'DELETE'])
def blog(request, name):
    blog = Blog.objects.filter(name=name).first()

    if request.method == 'GET':
        print(blog)
        if blog is None:
            return Response({"error": "no such blog exists"})
        blog = model_to_dict(blog)
        return Response(blog)

    elif request.method == 'POST':
        if blog is not None:
            return Response({"error": "blog with that name already exists"})
        elif isinstance(request.user, AnonymousUser):
            return Response({"error": "guest user cannot create blog"})
        else:
            Blog.objects.create(name=name, user=request.user)
            return Response({"ok": 1})

    elif request.method == 'DELETE':
        if blog is None:
            return Response({"error": "no such blog exists"})
        if blog.user != request.user:
            return Response({"error": "you are not the owner of that blog"})
        else:
            blog.delete()
            return Response({"ok": 1})


@api_view(['GET'])
def blog_posts(request, blog_name):
    posts = []
    for post in BlogPost.objects.filter(blog__name=blog_name):
        posts.append(model_to_dict(post))
    return Response(posts)


@api_view(['GET', 'POST', 'PUT', 'DELETE'])
def blog_post(request, blog_name, post_title):
    post = BlogPost.objects.filter(title=post_title, blog__name=blog_name).first()

    if request.method == 'GET':
        if post is None:
            return Response({"error": "no such post exists"})
        else:
            return Response(model_to_dict(post))

    blog = Blog.objects.filter(name=blog_name).first()

    if blog is None:
        return Response({"error": "no such blog exists"})

    if request.user != blog.user or isinstance(request.user, AnonymousUser):
        return Response({"error": "only owner of blog can do this action"})

    if request.method == 'POST':
        if post is not None:
            return Response({"error": "post with such title already exists"})
        else:
            BlogPost.objects.create(
                title=post_title,
                blog=blog,
                content=request.data.get("content", "")
            )
            return Response({"ok": 1})

    if request.method == 'PUT':
        if post is None:
            return Response({"error": "post with such title does not exist"})
        else:
            post.content = request.data.get("content", "")
            post.save()
            return Response({"ok": 1})

    elif request.method == 'DELETE':
        if post is None:
            return Response({"error": "post with such title does not exist"})
        else:
            post.delete()
            return Response({"ok": 1})

@api_view(['GET'])
def comments(request, blog_name, post_title):
    posts = []
    for post in BlogPost.objects.filter(blog__name=blog_name):
        posts.append(model_to_dict(post))
    return Response(posts)


@api_view(['GET', 'POST', 'PUT', 'DELETE'])
def comment(request, blog_name, post_title):
    post = BlogPost.objects.filter(title=post_title, blog__name=blog_name).first()

    if request.method == 'GET':
        if post is None:
            return Response({"error": "no such post exists"})
        else:
            return Response(model_to_dict(post))

    blog = Blog.objects.filter(name=blog_name).first()

    if blog is None:
        return Response({"error": "no such blog exists"})

    if request.user != blog.user or isinstance(request.user, AnonymousUser):
        return Response({"error": "only owner of blog can do this action"})

    if request.method == 'POST':
        if post is not None:
            return Response({"error": "post with such title already exists"})
        else:
            BlogPost.objects.create(
                title=post_title,
                blog=blog,
                content=request.data.get("content", "")
            )
            return Response({"ok": 1})

    if request.method == 'PUT':
        if post is None:
            return Response({"error": "post with such title does not exist"})
        else:
            post.content = request.data.get("content", "")
            post.save()
            return Response({"ok": 1})

    elif request.method == 'DELETE':
        if post is None:
            return Response({"error": "post with such title does not exist"})
        else:
            post.delete()
            return Response({"ok": 1})


@api_view(['GET'])
def get_blog_post_comments(request, blog_name, post_index):
    pass

@api_view(['POST'])
def create_blog_post_comment(request, blog_name, post_index, comment):
    pass

@api_view(['PUT'])
def update_blog_post_comment(request, blog_name, post_index, comment_index, comment):
    pass

@api_view(['DELETE'])
def delete_blog_post_comments(request, blog_name, post_index, comment_index):
    pass
