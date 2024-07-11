from django.urls import path

from apps.usuarios.views.tipos_usuarios.views import *
from apps.usuarios.views.usuarios.views import *


app_name = 'usuarios'

urlpatterns = [
    #Usuarios
    path('usuarios/list/', UsuariosListView.as_view(), name='usuarios_list'),
    path('usuarios/add/', UsuariosCreateView.as_view(), name='usuarios_create'),
    path('usuarios/update/<int:pk>/', UsuariosUpdateView.as_view(), name='usuarios_update'),
    path('usuarios/delete/<int:pk>/', UsuariosDeleteView.as_view(), name='usuarios_delete'),
    # Tipos de Usuarios
    path('tipo_usuario/list/', TiposUsuariosListView.as_view(), name='tipo_usuario_list'),
    path('tipo_usuario/add/', TiposUsuariosCreateView.as_view(), name='tipo_usuario_create'),
    path('tipo_usuario/update/<int:pk>/', TiposUsuariosUpdateView.as_view(), name='tipo_usuario_update'),
    path('tipo_usuario/delete/<int:pk>/', TiposUsuariosDeleteView.as_view(), name='tipo_usuario_delete'),

]
