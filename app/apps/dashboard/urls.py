from django.urls import path
from apps.dashboard.views import *

app_name = 'dashboard'

urlpatterns = [
    # home
    path('dashboard/', DashboardView.as_view(), name='home'),
]
