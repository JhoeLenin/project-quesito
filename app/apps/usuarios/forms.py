from django.forms import ModelForm, TextInput, PasswordInput, SelectMultiple, Select
from apps.usuarios.models import *


class UsuariosForm(ModelForm):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['first_name'].widget.attrs['autofocus'] = True

    class Meta:
        model = Usuarios
        #fields = '__all__'
        fields = 'tipo', 'first_name', 'last_name', 'username', 'password', 'dni', 'legajo', 'email', 'telefono', 'groups'
        widgets = {
            'tipo': Select(
                attrs={
                    'class': 'form-control select2',
                    'style': 'width: 100%'
                }
            ),
            'username': TextInput(
                attrs={
                    'placeholder': 'Ingrese un nombre de Usuario',
                }
            ),
            'password': PasswordInput(render_value=True,
                attrs={
                    'placeholder': 'Ingrese una contraseña',
                    'style': 'width: 100%'
                }
            ),
            'first_name': TextInput(
                attrs={
                    'placeholder': 'Ingrese los nombres',
                    'style': 'width: 100%'
                }
            ),
            'last_name': TextInput(
                attrs={
                    'placeholder': 'Ingrese el apellido',
                    'style': 'width: 100%'
                }
            ),
            'dni': TextInput(
                attrs={
                    'placeholder': 'Ingrese un DNI sin los puntos',
                }
            ),
            'legajo': TextInput(
                attrs={
                    'placeholder': 'Ingrese un legajo',
                    'style': 'width: 100%'
                }
            ),
            'email': TextInput(
                attrs={
                    'placeholder': 'Ingrese un correo electrónico válido',
                    'style': 'width: 100%'
                }
            ),
            'telefono': TextInput(
                attrs={
                    'placeholder': 'Ingrese un número de teléfono',
                    'style': 'width: 100%'
                }
            ),
            'groups': SelectMultiple(attrs={
                'class': 'form-control select2',
                'style': 'width: 100%',
                'multiple': 'multiple'
            })
        }
        exclude = ['user_permissions', 'last_login', 'date_joined', 'is_superuser', 'is_active', 'is_staff']

    def save(self, commit=True):
        data = {}
        form = super()
        try:
            if form.is_valid():
                pwd = self.cleaned_data['password']
                u = form.save(commit=False)
                if u.pk is None:
                    u.set_password(pwd)
                else:
                    user = Usuarios.objects.get(pk=u.pk)
                    if user.password != pwd:
                        u.set_password(pwd)
                u.save()

                #limpiar los grupos que tiene el usuario
                u.groups.clear()

                #cargar los grupos que tiene el usuario
                for g in self.cleaned_data['groups']:
                    u.groups.add(g)
            else:
                data['error'] = form.errors
        except Exception as e:
            data['error'] = str(e)
        return data


class TiposUsuariosForm(ModelForm):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['nombre'].widget.attrs['autofocus'] = True

    class Meta:
        model = TiposUsuarios
        fields = '__all__'
        widgets = {
            'nombre': TextInput(
                attrs={
                    'placeholder': 'Ingrese un nombre',
                    # agregamos este estilo para que convierta lo que ingresamos a mayuscula
                    'style': 'text-transform: uppercase',
                }
            ),
        }

    def save(self, commit=True):
        data = {}
        form = super()
        try:
            if form.is_valid():
                form.save()
            else:
                data['error'] = form.errors
        except Exception as e:
            data['error'] = str(e)
        return data