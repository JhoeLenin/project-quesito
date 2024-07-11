from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import JsonResponse
from django.urls import reverse_lazy
from django.views.decorators.csrf import csrf_exempt
from django.views.generic import ListView, CreateView, UpdateView, DeleteView
from django.utils.decorators import method_decorator

from apps.parametros.forms import TiposDocumentosForm
from apps.parametros.models import TiposDocumentos
from apps.mixins import ValidatePermissionRequiredMixin

class TiposDocumentosListView(LoginRequiredMixin, ValidatePermissionRequiredMixin, ListView):
    model = TiposDocumentos
    template_name = 'tipos_documentos/list.html'
    permission_required = 'parametros.view_tiposdocumentos'

    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, *args, **kwargs):
        data = {}
        try:
            action = request.POST['action']
            if action == 'searchdata':
                data = []
                for i in TiposDocumentos.objects.all():
                    data.append(i.toJSON())
            else:
                data['error'] = 'Ha ocurrido un error'
        except Exception as e:
            data['error'] = str(e)
        return JsonResponse(data, safe=False)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['title'] = 'Listado de Tipos de Documentos'
        context['create_url'] = reverse_lazy('parametros:tipos_documentos_create')
        context['list_url'] = reverse_lazy('parametros:tipos_documentos_list')
        context['entity'] = 'Tipos de Documentos'
        return context

class TiposDocumentosCreateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, CreateView):
    model = TiposDocumentos
    form_class = TiposDocumentosForm
    template_name = 'tipos_documentos/create.html'
    success_url = reverse_lazy('parametros:tipos_documentos_list')
    permission_required = 'parametros.add_tiposdocumentos'
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
        context['title'] = 'Crear un Tipo de Documento'
        context['entity'] = 'Tipos de Documentos'
        context['list_url'] = reverse_lazy('parametros:tipos_documentos_list')
        context['action'] = 'add'
        return context

class TiposDocumentosUpdateView(LoginRequiredMixin, ValidatePermissionRequiredMixin, UpdateView):
    model = TiposDocumentos
    form_class = TiposDocumentosForm
    template_name = 'tipos_documentos/create.html'
    success_url = reverse_lazy('parametros:tipos_documentos_list')
    permission_required = 'parametros.change_tiposdocumentos'
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
        context['title'] = 'Editar Tipo de Documento'
        context['entity'] = 'Tipos de Documentos'
        context['list_url'] = reverse_lazy('parametros:tipos_documentos_list')
        context['action'] = 'edit'
        return context

class TiposDocumentosDeleteView(LoginRequiredMixin, ValidatePermissionRequiredMixin, DeleteView):
    model = TiposDocumentos
    template_name = 'tipos_documentos/delete.html'
    success_url = reverse_lazy('parametros:tipos_documentos_list')
    permission_required = 'parametros.delete_tiposdocumentos'
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
        context['title'] = 'Eliminar Tipo de Documento'
        context['entity'] = 'Tipos de Documentos'
        context['list_url'] = reverse_lazy('parametros:tipos_documentos_list')
        return context