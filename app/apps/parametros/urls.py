from django.urls import path

from apps.parametros.views.tipos_documentos.views import *
from apps.parametros.views.sexos.views import *
from apps.parametros.views.tarjetas.views import *
from apps.parametros.views.estados.views import *

app_name = 'parametros'

urlpatterns = [
    #Tipo de Documento
    path('tipos_documentos/list/', TiposDocumentosListView.as_view(), name='tipos_documentos_list'),
    path('tipos_documentos/add/', TiposDocumentosCreateView.as_view(), name='tipos_documentos_create'),
    path('tipos_documentos/update/<int:pk>/', TiposDocumentosUpdateView.as_view(), name='tipos_documentos_update'),
    path('tipos_documentos/delete/<int:pk>/', TiposDocumentosDeleteView.as_view(), name='tipos_documentos_delete'),
    #Sexos
    path('sexos/list/', SexosListView.as_view(), name='sexos_list'),
    path('sexos/add/', SexosCreateView.as_view(), name='sexos_create'),
    path('sexos/update/<int:pk>/', SexosUpdateView.as_view(), name='sexos_update'),
    path('sexos/delete/<int:pk>/', SexosDeleteView.as_view(), name='sexos_delete'),
    #Tarjetas
    path('tarjetas/list/', TarjetasListView.as_view(), name='tarjetas_list'),
    path('tarjetas/add/', TarjetasCreateView.as_view(), name='tarjetas_create'),
    path('tarjetas/update/<int:pk>/', TarjetasUpdateView.as_view(), name='tarjetas_update'),
    path('tarjetas/delete/<int:pk>/', TarjetasDeleteView.as_view(), name='tarjetas_delete'),
    # Estados
    path('estados/list/', EstadosListView.as_view(), name='estados_list'),
    path('estados/add/', EstadosCreateView.as_view(), name='estados_create'),
    path('estados/update/<int:pk>/', EstadosUpdateView.as_view(), name='estados_update'),
    path('estados/delete/<int:pk>/', EstadosDeleteView.as_view(), name='estados_delete'),
]
