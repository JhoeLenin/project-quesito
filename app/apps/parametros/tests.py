from config.wsgi import *
from apps.geografico.models import *
import random

data = ['Argentina', 'Bolivia', 'Brasil', 'Chile', 'Colombia', 'Costa Rica',
        'Cuba', 'Ecuador', 'Estados Unidos', 'México', 'Paraguay', 'Perú',
        'Uruguay', 'Venezuela']

# delete from public.paises;
# ALTER SEQUENCE paises_id_pais_seq RESTART WITH 1;

letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
           'u', 'v', 'w', 'x', 'y', 'z']

for i in range(1, 6000):
    name = ''.join(random.choices(letters, k=5))
    while Paises.objects.filter(name=name).exists():
        name = ''.join(random.choices(letters, k=5))
    Category(name=name).save()
    print('Guardado registro {}'.format(i))