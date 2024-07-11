from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.parametros.forms import SexosForm
from apps.parametros.models import Sexos
from apps.mixins import ValidatePermissionRequiredMixin

class SexosListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Sexos
    template_name = 'sexos/list.html'
    permission_required = 'parametros.view_sexos'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Sexos.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Sexos'
        context['create_url'] = reverse_lazy('parametros:sexos_create')
        context['list_url'] = reverse_lazy('parametros:sexos_list')
        context['entity'] = 'Sexos'
        return context

class SexosCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Sexos
    form_class = SexosForm
    template_name = 'sexos/create.html'
    success_url = reverse_lazy('parametros:sexos_list')
    permission_required = 'parametros.add_sexos'
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
        context['title'] = 'Crear un Sexo'
        context['entity'] = 'Sexos'
        context['list_url'] = reverse_lazy('parametros:sexos_list')
        context['action'] = 'add'
        return context

class SexosUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Sexos
    form_class = SexosForm
    template_name = 'sexos/create.html'
    success_url = reverse_lazy('parametros:sexos_list')
    permission_required = 'parametros.change_sexos'
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
        context['title'] = 'Editar Sexo'
        context['entity'] = 'Sexos'
        context['list_url'] = reverse_lazy('parametros:sexos_list')
        context['action'] = 'edit'
        return context

class SexosDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Sexos
    template_name = 'sexos/delete.html'
    success_url = reverse_lazy('parametros:sexos_list')
    permission_required = 'parametros.delete_sexos'
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
        context['title'] = 'Eliminar Sexo'
        context['entity'] = 'Sexos'
        context['list_url'] = reverse_lazy('parametros:sexos_list')
        return context