from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.shortcuts import redirect
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.geografico.forms import LocalidadesForm
from apps.geografico.models import Localidades, Provincias
from apps.mixins import ValidatePermissionRequiredMixin

class LocalidadesListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = Localidades
    template_name = 'localidades/list.html'
    permission_required = 'geografico.view_localidades'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in Localidades.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Localidades'
        context['create_url'] = reverse_lazy('geografico:localidades_create')
        context['list_url'] = reverse_lazy('geografico:localidades_list')
        context['entity'] = 'Localidades'
        return context


class LocalidadesCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = Localidades
    form_class = LocalidadesForm
    template_name = 'localidades/create.html'
    success_url = reverse_lazy('geografico:localidades_list')
    permission_required = 'geografico.add_localidades'
    url_redirect = success_url

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'search_provincia_id':
                data = [{'id': '', 'text': '---------'}]
                for i in Provincias.objects.filter(pais_id=request.POST['id']):
                    data.append({'id': i.id, 'text': i.nombre})
            elif action == 'add':
                form = LocalidadesForm(request.POST)
                if form.is_valid():
                    form = self.get_form()
                    data = form.save()
                return redirect('geografico:localidades_list')
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Crear una Localidad'
        context['entity'] = 'Localidades'
        context['list_url'] = reverse_lazy('geografico:localidades_list')
        context['action'] = 'add'
        return context


class LocalidadesUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = Localidades
    form_class = LocalidadesForm
    template_name = 'localidades/update.html'
    success_url = reverse_lazy('geografico:localidades_list')
    permission_required = 'geografico.change_localidades'
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
        context['title'] = 'Editar Localidad'
        context['entity'] = 'Localidades'
        context['list_url'] = reverse_lazy('geografico:localidades_list')
        context['action'] = 'edit'
        return context


class LocalidadesDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = Localidades
    template_name = 'localidades/delete.html'
    success_url = reverse_lazy('geografico:localidades_list')
    permission_required = 'geografico.delete_localidades'
    url_redirect = success_url

    # @method_decorator(login_required)
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
        context['title'] = 'Eliminar Localidad'
        context['entity'] = 'Localidades'
        context['list_url'] = reverse_lazy('geografico:localidades_list')
        return context
