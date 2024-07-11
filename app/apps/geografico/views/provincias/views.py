from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.geografico.forms import ProvinciasForm
from apps.geografico.models import Provincias
from apps.mixins import ValidatePermissionRequiredMixin


class ProvinciasListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Provincias
    template_name = 'provincias/list.html'
    permission_required = 'geografico.view_provincias'

    @method_decorator(csrf_exempt)
    #@method_decorator(login_required)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Provincias.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Provincias'
        context['create_url'] = reverse_lazy('geografico:provincias_create')
        context['list_url'] = reverse_lazy('geografico:provincias_list')
        context['entity'] = 'Provincias'
        return context


class ProvinciasCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Provincias
    form_class = ProvinciasForm
    template_name = 'provincias/create.html'
    success_url = reverse_lazy('geografico:provincias_list')
    permission_required = 'geografico.add_provincias'
    url_redirect = success_url

    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'add':
                form = ProvinciasForm(request.POST)
                form = self.get_form()
                data = form.save()
            else:
                data['error'] = 'No ha ingresado ninguna opción'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Crear una Provincia'
        context['entity'] = 'Provincias'
        context['list_url'] = reverse_lazy('geografico:provincias_list')
        context['action'] = 'add'
        return context


class ProvinciasUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Provincias
    form_class = ProvinciasForm
    template_name = 'provincias/create.html'
    success_url = reverse_lazy('geografico:provincias_list')
    permission_required = 'geografico.change_provincias'
    url_redirect = success_url

    #@method_decorator(login_required)
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
        context['title'] = 'Editar Provincia'
        context['entity'] = 'Provincias'
        context['list_url'] = reverse_lazy('geografico:provincias_list')
        context['action'] = 'edit'
        return context

class ProvinciasDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Provincias
    template_name = 'provincias/delete.html'
    success_url = reverse_lazy('geografico:provincias_list')
    permission_required = 'geografico.delete_provincias'
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
        context['title'] = 'Eliminar Provincia'
        context['entity'] = 'Provincias'
        context['list_url'] = reverse_lazy('geografico:provincias_list')
        return context