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


class Product(models.Model):
    img_name = models.CharField(primary_key=True, max_length=10)
    price = models.FloatField()
    category = models.CharField(choices=(('T-Shirt', 'T-Shirt'), ('Mug', 'Mug'), ('Blouse', 'Blouse')), max_length=10)


class Order(models.Model):
    id = models.CharField(primary_key=True, max_length=200)
    name = models.CharField(max_length=100, blank=False, null=False)
    surname = models.CharField(max_length=100, blank=False, null=False)
    city = models.CharField(max_length=100, blank=False, null=False)
    address = models.CharField(max_length=200, blank=False, null=False)
    products = models.CharField(max_length=400, blank=False, null=False)
    delivery = models.CharField(max_length=100, blank=False, null=False)
    price = models.FloatField(blank=False, null=False)
