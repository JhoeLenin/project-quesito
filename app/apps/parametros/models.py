from django.db import models

from django.forms import model_to_dict

#   Clase Tipo de Documento
class TiposDocumentos(models.Model):
    nombre = models.TextField(verbose_name='Nombre', unique=True)
    descripcion = models.TextField(verbose_name='Descripción', null=True, blank=True)

    def __str__(self):
        return self.nombre

    def toJSON(self):
        item = model_to_dict(self)
        return item

    class Meta:
        verbose_name = 'Tipo de Documento'
        verbose_name_plural = 'Tipos de Documentos'
        db_table = 'tipos_documentos'
        ordering = ['id']

    # Para convertir a MAYUSCULA
    def save(self, force_insert=False, force_update=False):
        self.nombre = self.nombre.upper()
        self.descripcion = self.descripcion.upper()
        super(TiposDocumentos, self).save(force_insert, force_update)

#   Clase Sexos
class Sexos(models.Model):
    nombre = models.TextField(verbose_name='Nombre', unique=True)

    def __str__(self):
        return self.nombre

    def toJSON(self):
        item = model_to_dict(self)
        return item

    class Meta:
        verbose_name = 'Sexo'
        verbose_name_plural = 'Sexos'
        db_table = 'sexos'
        ordering = ['id']

    # Para convertir a MAYUSCULA
    def save(self, force_insert=False, force_update=False):
        self.nombre = self.nombre.upper()
        super(Sexos, self).save(force_insert, force_update)

#   Clase Tarjetas
class Tarjetas(models.Model):
    nombre = models.TextField(verbose_name='Nombre', unique=True)
    codigo = models.TextField(verbose_name='Código', null=True, blank=True)

    def __str__(self):
        return self.nombre

    def toJSON(self):
        item = model_to_dict(self)
        return item

    class Meta:
        verbose_name = 'Tarjeta de Aproximación'
        verbose_name_plural = 'Tarjetas de Aproximación'
        db_table = 'tarjetas_aproximacion'
        ordering = ['id']

    # Para convertir a MAYUSCULA
    def save(self, force_insert=False, force_update=False):
        self.nombre = self.nombre.upper()
        self.codigo = self.codigo.upper()
        super(Tarjetas, self).save(force_insert, force_update)

#   Clase Estados
class Estados(models.Model):
    nombre = models.TextField(verbose_name='Nombre', unique=True)

    def __str__(self):
        return self.nombre

    def toJSON(self):
        item = model_to_dict(self)
        return item

    class Meta:
        verbose_name = 'Estado'
        verbose_name_plural = 'Estados'
        db_table = 'estados'
        ordering = ['id']

    # Para convertir a MAYUSCULA
    def save(self, force_insert=False, force_update=False):
        self.nombre = self.nombre.upper()
        super(Estados, self).save(force_insert, force_update)