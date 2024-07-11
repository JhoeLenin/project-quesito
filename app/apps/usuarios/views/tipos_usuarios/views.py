from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.shortcuts import render
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.usuarios.forms import TiposUsuariosForm
from apps.usuarios.models import TiposUsuarios
from apps.mixins import ValidatePermissionRequiredMixin


class TiposUsuariosListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = TiposUsuarios
    template_name = 'tipos_usuarios/list.html'
    permission_required = 'usuarios.view_tiposusuarios'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in TiposUsuarios.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Tipos de Usuarios'
        context['create_url'] = reverse_lazy('usuarios:tipo_usuario_create')
        context['list_url'] = reverse_lazy('usuarios:tipo_usuario_list')
        context['entity'] = 'Tipos de Usuarios'
        return context


class TiposUsuariosCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = TiposUsuarios
    form_class = TiposUsuariosForm
    template_name = 'tipos_usuarios/create.html'
    success_url = reverse_lazy('usuarios:tipo_usuario_list')
    permission_required = 'usuarios.add_tiposusuarios'
    url_redirect = success_url

    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'add':
                form = self.get_form()
                data = form.save()
            else:
                data['error'] = 'No ha ingresado ninguna opción'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Crear un Tipo de Usuario'
        context['entity'] = 'Tipos de Usuarios'
        context['list_url'] = reverse_lazy('usuarios:tipo_usuario_list')
        context['action'] = 'add'
        return context


class TiposUsuariosUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = TiposUsuarios
    form_class = TiposUsuariosForm
    template_name = 'tipos_usuarios/create.html'
    success_url = reverse_lazy('usuarios:tipo_usuario_list')
    permission_required = 'usuarios.change_tiposusuarios'
    url_redirect = success_url

    def dispatch(self, request, *args, **kwargs):
        self.object = self.get_object()
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'edit':
                form = self.get_form()
                data = form.save()
            else:
                data['error'] = 'No ha ingresado ninguna opción'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Editar Tipo de Usuario'
        context['entity'] = 'Tipos de Usuarios'
        context['list_url'] = reverse_lazy('usuarios:tipo_usuario_list')
        context['action'] = 'edit'
        return context

class TiposUsuariosDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = TiposUsuarios
    template_name = 'tipos_usuarios/delete.html'
    success_url = reverse_lazy('usuarios:tipo_usuario_list')
    permission_required = 'usuarios.delete_tiposusuarios'
    url_redirect = success_url

    def dispatch(self, request, *args, **kwargs):
        self.object = self.get_object()
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            self.object.delete()
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Eliminar Tipo de Usuario'
        context['entity'] = 'Tipos de Usuarios'
        context['list_url'] = reverse_lazy('usuarios:tipo_usuario_list')
        return context