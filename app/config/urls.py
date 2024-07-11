from django.contrib import admin
from django.urls import path, include
#from apps.login.views import LoginFormView

urlpatterns = [
    path('admin/', admin.site.urls),
    path('geografico/', include('apps.geografico.urls')),
    path('parametros/', include('apps.parametros.urls')),
    path('', include('apps.login.urls')),
    path('', include('apps.dashboard.urls')),
    path('', include('apps.usuarios.urls')),
]
