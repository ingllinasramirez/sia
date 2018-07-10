{% if enMantenimiento == 'SI' %}
    {% include mantenimiento %}
{% else %}
    {% if estaLogueado %}
        {% if isEstadoSesion == 'SIA' %} 
            {% include admin %}
        {% else %}
            {% include bloqueo %}
        {% endif %}
    {% else %}
        {% include login %}
    {% endif %}
{% endif %}