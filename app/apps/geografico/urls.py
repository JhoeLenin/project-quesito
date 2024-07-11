from django.urls import path

from apps.geografico.views.paises.views import *
from apps.geografico.views.provincias.views import *
from apps.geografico.views.localidades.views import *

app_name = 'geografico'

urlpatterns = [
    #PAISES
    path('paises/list/', PaisesListView.as_view(), name='paises_list'),
    path('paises/add/', PaisesCreateView.as_view(), name='paises_create'),
    path('paises/update/<int:pk>/', PaisesUpdateView.as_view(), name='paises_update'),
    path('paises/delete/<int:pk>/', PaisesDeleteView.as_view(), name='paises_delete'),
    #Provincias
    path('provincias/list/', ProvinciasListView.as_view(), name='provincias_list'),
    path('provincias/add/', ProvinciasCreateView.as_view(), name='provincias_create'),
    path('provincias/update/<int:pk>/', ProvinciasUpdateView.as_view(), name='provincias_update'),
    path('provincias/delete/<int:pk>/', ProvinciasDeleteView.as_view(), name='provincias_delete'),
    #Localidades
    path('localidades/list/', LocalidadesListView.as_view(), name='localidades_list'),
    path('localidades/add/', LocalidadesCreateView.as_view(), name='localidades_create'),
    path('localidades/update/<int:pk>/', LocalidadesUpdateView.as_view(), name='localidades_update'),
    path('localidades/delete/<int:pk>/', LocalidadesDeleteView.as_view(), name='localidades_delete'),
    
]
