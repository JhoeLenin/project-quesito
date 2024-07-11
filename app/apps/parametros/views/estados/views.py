from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.parametros.forms import EstadosForm
from apps.parametros.models import Estados
from apps.mixins import ValidatePermissionRequiredMixin

class EstadosListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Estados
    template_name = 'estados/list.html'
    permission_required = 'parametros.view_estados'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Estados.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Estados'
        context['create_url'] = reverse_lazy('parametros:estados_create')
        context['list_url'] = reverse_lazy('parametros:estados_list')
        context['entity'] = 'Estados'
        return context

class EstadosCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Estados
    form_class = EstadosForm
    template_name = 'estados/create.html'
    success_url = reverse_lazy('parametros:estados_list')
    permission_required = 'parametros.add_estados'
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
        context['title'] = 'Crear un Estado'
        context['entity'] = 'Estados'
        context['list_url'] = reverse_lazy('parametros:estados_list')
        context['action'] = 'add'
        return context

class EstadosUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Estados
    form_class = EstadosForm
    template_name = 'estados/create.html'
    success_url = reverse_lazy('parametros:estados_list')
    permission_required = 'parametros.change_estados'
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
        context['title'] = 'Editar Estado'
        context['entity'] = 'Estados'
        context['list_url'] = reverse_lazy('parametros:estados_list')
        context['action'] = 'edit'
        return context

class EstadosDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Estados
    template_name = 'estados/delete.html'
    success_url = reverse_lazy('parametros:estados_list')
    permission_required = 'parametros.delete_estados'
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
        context['title'] = 'Eliminar Estado'
        context['entity'] = 'Estados'
        context['list_url'] = reverse_lazy('parametros:estados_list')
        return context