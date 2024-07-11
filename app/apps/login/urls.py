from django.urls import path

from apps.login.views import *

urlpatterns = [
    path('', LoginFormView.as_view(), name='login'),
    path('login/', LoginFormView.as_view(), name='login'),
    path('logout/', LogoutView.as_view(), name='logout'),
]