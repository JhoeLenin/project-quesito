from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.geografico.forms import PaisesForm
from apps.geografico.models import Paises
from apps.mixins import ValidatePermissionRequiredMixin


class PaisesListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Paises
    template_name = 'paises/list.html'
    permission_required = 'geografico.view_paises'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Paises.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Países'
        context['create_url'] = reverse_lazy('geografico:paises_create')
        context['list_url'] = reverse_lazy('geografico:paises_list')
        context['entity'] = 'Paises'
        return context


class PaisesCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Paises
    form_class = PaisesForm
    template_name = 'paises/create.html'
    success_url = reverse_lazy('geografico:paises_list')
    permission_required = 'geografico.add_paises'
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
        context['title'] = 'Crear un País'
        context['entity'] = 'Paises'
        context['list_url'] = reverse_lazy('geografico:paises_list')
        context['action'] = 'add'
        return context


class PaisesUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Paises
    form_class = PaisesForm
    template_name = 'paises/create.html'
    success_url = reverse_lazy('geografico:paises_list')
    permission_required = 'geografico.change_paises'
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
        context['title'] = 'Editar País'
        context['entity'] = 'Países'
        context['list_url'] = reverse_lazy('geografico:paises_list')
        context['action'] = 'edit'
        return context

class PaisesDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Paises
    template_name = 'paises/delete.html'
    success_url = reverse_lazy('geografico:paises_list')
    permission_required = 'geografico.delete_paises'
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
        context['title'] = 'Eliminar País'
        context['entity'] = 'Países'
        context['list_url'] = reverse_lazy('geografico:paises_list')
        return context