from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.parametros.forms import TarjetasForm
from apps.parametros.models import Tarjetas
from apps.mixins import ValidatePermissionRequiredMixin

class TarjetasListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Tarjetas
    template_name = 'tarjetas/list.html'
    permission_required = 'parametros.view_tarjetas'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Tarjetas.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Tarjetas'
        context['create_url'] = reverse_lazy('parametros:tarjetas_create')
        context['list_url'] = reverse_lazy('parametros:tarjetas_list')
        context['entity'] = 'Tarjetas'
        return context

class TarjetasCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Tarjetas
    form_class = TarjetasForm
    template_name = 'tarjetas/create.html'
    success_url = reverse_lazy('parametros:tarjetas_list')
    permission_required = 'parametros.add_tarjetas'
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
        context['title'] = 'Crear una Tarjeta'
        context['entity'] = 'Tarjetas'
        context['list_url'] = reverse_lazy('parametros:tarjetas_list')
        context['action'] = 'add'
        return context

class TarjetasUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Tarjetas
    form_class = TarjetasForm
    template_name = 'tarjetas/create.html'
    success_url = reverse_lazy('parametros:tarjetas_list')
    permission_required = 'parametros.change_tarjetas'
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
        context['title'] = 'Editar Tarjeta'
        context['entity'] = 'Tarjetas'
        context['list_url'] = reverse_lazy('parametros:tarjetas_list')
        context['action'] = 'edit'
        return context

class TarjetasDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Tarjetas
    template_name = 'tarjetas/delete.html'
    success_url = reverse_lazy('parametros:tarjetas_list')
    permission_required = 'parametros.delete_tarjetas'
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
        context['title'] = 'Eliminar Tarjeta'
        context['entity'] = 'Tarjetas'
        context['list_url'] = reverse_lazy('parametros:tarjetas_list')
        return context