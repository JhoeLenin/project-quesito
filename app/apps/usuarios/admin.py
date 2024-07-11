from django.contrib import admin

# Register your models here.
from apps.usuarios.models import Usuarios

admin.site.register(Usuarios)