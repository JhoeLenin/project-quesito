from django.contrib.auth.models import AbstractUser
from django.db import models

#from apps.inst.models import Facultad
from django.forms import model_to_dict

#   Clase Tipos de Usuarios
class TiposUsuarios(models.Model):
    nombre = models.TextField(verbose_name='Nombre', unique=True)

    def __str__(self):
        return self.nombre

    def toJSON(self):
        item = model_to_dict(self)
        return item

    class Meta:
        verbose_name = 'Tipo'
        verbose_name_plural = 'Tipos'
        db_table = 'usuarios_tipos'
        ordering = ['id']

    # Para convertir a MAYUSCULA
    def save(self, force_insert=False, force_update=False):
        self.nombre = self.nombre.upper()
        super(TiposUsuarios, self).save(force_insert, force_update)

#   Clase Usuarios
class Usuarios(AbstractUser):
    legajo = models.CharField(max_length=10, null=True, blank=True, verbose_name='Legajo')
    dni = models.PositiveIntegerField(verbose_name='Documento', null=True, blank=True)
    telefono = models.TextField(null=True, blank=True)
    tipo = models.ForeignKey(TiposUsuarios, models.DO_NOTHING,  null=True, blank=True, verbose_name='Tipo')

    def toJSON(self):
        item = model_to_dict(self, exclude=['password', 'user_permissions', 'last_login', 'date_joined'])
        item['full_name'] = self.get_full_name()
        item['groups'] = [{'id': g.id, 'name': g.name} for g in self.groups.all()]
        return item
