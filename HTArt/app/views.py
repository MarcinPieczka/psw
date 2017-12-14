from django.shortcuts import render


def index(request):
    return render(request, 'app/index.html')


def work_1(request):
    return render(request, 'app/work-1.html')


def work_2(request):
    return render(request, 'app/work-2.html')


def work_3(request):
    return render(request, 'app/work-3.html')
