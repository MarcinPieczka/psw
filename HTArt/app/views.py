from django.contrib.auth.models import User
from django.core import serializers
from django.shortcuts import render
from rest_framework import status
from rest_framework.decorators import api_view
from rest_framework.response import Response
from random import randint, random

from app.models import Comments, BlogPost

from app.models import Product


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


@api_view()
def get_comments(request, page_id):
    return Response(serializers.serialize('json',
                    Comments.objects.filter(page_id=page_id)))


@api_view(['POST'])
def post_comments(request):
    print(request.data)
    user = User.objects.filter(username=request.data.user)[0]

    return Response("just a test", status=status.HTTP_200_OK)


@api_view()
def get_blog_posts(request, username):
    return Response(serializers.serialize('json',
                    BlogPost.objects.filter(user__username=username)))


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
