from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.mixins import ValidatePermissionRequiredMixin
from apps.usuarios.forms import UsuariosForm
from apps.usuarios.models import Usuarios


class UsuariosListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Usuarios
    template_name = 'usuarios/list.html'
    permission_required = 'usuarios.view_usuarios'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Usuarios.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Usuarios'
        context['create_url'] = reverse_lazy('usuarios:usuarios_create')
        context['list_url'] = reverse_lazy('usuarios:usuarios_list')
        context['entity'] = 'Usuarios'
        return context

class UsuariosCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Usuarios
    form_class = UsuariosForm
    template_name = 'usuarios/create.html'
    success_url = reverse_lazy('usuarios:usuarios_list')
    permission_required = 'usuarios.add_usuarios'
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
        context['title'] = 'Crear un Usuario'
        context['entity'] = 'Usuario'
        context['list_url'] = reverse_lazy('usuarios:usuarios_list')
        context['action'] = 'add'
        return context

class UsuariosUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Usuarios
    form_class = UsuariosForm
    template_name = 'usuarios/create.html'
    success_url = reverse_lazy('usuarios:usuarios_list')
    permission_required = 'usuarios.change_usuarios'
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
        context['title'] = 'Editar Usuario'
        context['entity'] = 'Usuarios'
        context['list_url'] = reverse_lazy('usuarios:usuarios_list')
        context['action'] = 'edit'
        return context

class UsuariosDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Usuarios
    template_name = 'usuarios/delete.html'
    success_url = reverse_lazy('usuarios:usuarios_list')
    permission_required = 'usuarios.delete_usuarios'
    url_redirect = success_url

    #@method_decorator(login_required)
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
        context['title'] = 'Eliminar Usuario'
        context['entity'] = 'Usuario'
        context['list_url'] = reverse_lazy('usuarios:usuarios_list')
        return context
