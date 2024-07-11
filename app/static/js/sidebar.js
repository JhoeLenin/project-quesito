 // Obtenemos solo el <a> que contenga el path actual. Es irrepetible por definición.
            var link_sidebar = $("a[href='{{request.path}}']");
            
            // Activamos el elemento. 
            link_sidebar[0].classList = 'nav-link active';
            
            // Hacemos un recorrido recursivo de "abajo hacia arriba" del sidebar para ir abriendo menúes
            var els = [];
            var profundidad = 0;    //Controla la profundidad. Si hay muchos menúes anidados se debe aumentar.
            
            while (link_sidebar[0] && profundidad < 7) {
                if(link_sidebar[0].classList.value.includes('nav-item')){
                    link_sidebar[0].classList.value = 'nav-item menu-is-opening menu-open';
                }
                els.unshift(link_sidebar[0]);
                link_sidebar[0] = link_sidebar[0].parentNode;
                profundidad++;
            }
