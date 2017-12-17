from django.contrib.auth.models import User
from django.core import serializers
from django.shortcuts import render
from rest_framework import status
from rest_framework.decorators import api_view
from rest_framework.response import Response

from app.models import Comments, BlogPost


def index(request):
    return render(request, 'app/index.html')


def work_1(request):
    return render(request, 'app/work-1.html')


def work_2(request):
    return render(request, 'app/work-2.html')


def work_3(request):
    return render(request, 'app/work-3.html')


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
