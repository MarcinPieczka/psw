from datetime import datetime

from django.contrib.auth.models import User
from django.db import models


class Comments(models.Model):
    page_id = models.IntegerField()
    user = models.ForeignKey(User, on_delete=models.PROTECT)
    created = models.DateTimeField(default=datetime.now())
    text = models.TextField(max_length=400)


class BlogPost(models.Model):
    user = models.ForeignKey(User, on_delete=models.PROTECT)
    created = models.DateTimeField(default=datetime.now())
    title = models.TextField(max_length=100)
    text = models.TextField(max_length=40000)
