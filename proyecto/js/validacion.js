$(document).ready(function(){
    
    $.validator.addMethod('ValidarNombre', function(value, element){
        return this.optional(element) || /[a-záéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'Nombre(s) solo puede contener letras');

    $.validator.addMethod('ValidarApellidoPaterno', function(value, element){
        return this.optional(element) || /[a-z áéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'El apellido paterno solo puede contener letras');

    $.validator.addMethod('ValidarApellidoMaterno', function(value, element){
        return this.optional(element) || /[a-z áéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'El apellido materno solo puede contener letras');

    $.validator.addMethod('ValidarDomicilio', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/g.test(value.trim());
    }, 'El domicilio no es válido');

    $.validator.addMethod('ValidarCorreo', function(value, element){
        return this.optional(element) || /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(value.trim());
    }, 'El correo electrónico no es válido');

    $.validator.addMethod('ValidarTelefono', function(value, element){
        return this.optional(element) || /^[0-9]/.test(value.trim());
    }, 'El teléfono solo puede contener dígitos');

    $.validator.addMethod('ValidarCedula', function(value, element){
        return this.optional(element) || /^[0-9a-zA-Z-_.]/.test(value.trim());
    }, 'Cédula no válida');


    $.validator.addMethod('ValidarPassword', function(value, element){
        return this.optional(element) || /(?=^[\w\!@#\$%\^&\*\?]{8,256}$)(?=(.*\d){2,})(?=(.*[a-z]){2,})(?=(.*[A-Z]){2,})(?=(.*[\!@#\$%\^&\*\?_]){2,})^.*/.test(value.trim());
    }, 'La contraseña debe contener al menos 2 letras minúsculas, 2 letras mayúsculas, 2 números y 2 de los siguientes simbolos !, @, #, $, %, ^, &, *, ?');

    $.validator.addMethod('ValidarUsuario', function(value, element){
        if (/^[0-9]/.test(value.trim())){
            return this.optional(element) || /^[0-9]{10}/.test(value.trim());
        }
        else{
            return this.optional(element) || /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(value.trim());
        }
    }, 'El correo electrónico o teléfono no es válido');

    $.validator.addMethod('ValidarPeso', function(value, element){
        return this.optional(element) || /^[0-9.]/.test(value.trim());
    }, 'El peso debe ser un número entre 0.500 y 6.00');

    $.validator.addMethod('ValidarTalla', function(value, element){
        return this.optional(element) || /^[0-9.]/.test(value.trim());
    }, 'La talla debe ser un número entre 35.0 y 60.0');

    $.validator.addMethod('EdadGestacional', function(value, element){
        return this.optional(element) || /^[0-9]/.test(value.trim());
    }, 'La edad gestacional debe ser un número entero entre 30 y 41');
    
    $.validator.addMethod('ValidarComplicaciones', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/g.test(value.trim());
    }, 'Las complicaciones en el nacimiento solo pueden contener letras y números');

    $.validator.addMethod('ValidarNombre', function(value, element){
        return this.optional(element) || /[a-záéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'Nombre(s) solo puede contener letras');

    $.validator.addMethod('ValidarNombreHospital', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'El nombre del hospital solo puede contener letras y números');

    $.validator.addMethod('ValidarLugar', function(value, element){
        return this.optional(element) || /[a-záéíóúÁÉÍÓÚñÑ\s]$/i.test(value.trim());
    }, 'El lugar de nacimiento solo puede contener letras');

    $.validator.addMethod('ValidarPadecimiento', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/i.test(value.trim());
    }, 'El padecimiento solo puede contener letras y números');

    $.validator.addMethod('ValidarDuracion', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/i.test(value.trim());
    }, 'La duración solo puede contener letras y números');

    $.validator.addMethod('ValidarTratamiento', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/i.test(value.trim());
    }, 'El tratamiento solo puede contener letras y números');

    $.validator.addMethod('ValidarDescripcion', function(value, element){
        return this.optional(element) || /[a-z0-9áéíóúÁÉÍÓÚñÑ.,\s]$/i.test(value.trim());
    }, 'La descripción solo puede contener letras y números');

    $("#registro-medico").validate({
        errorPlacement: function(error, element){
            if (element.attr('type') == 'checkbox'){
                error.insertAfter(element.parent('label').parent('div').parent('div'));
            }
            else{
                error.insertAfter(element);
            }
        },
        rules:{
            nombre:{
                required: true,
                ValidarNombre: true,
                minlength: 3
            },
            apellido_paterno:{
                required: true,
                ValidarApellidoPaterno: true,
                minlength: 3
            },
            apellido_materno:{
                required: true,
                ValidarApellidoMaterno: true,
                minlength: 3
            },
            domicilio:{
                required: true,
                ValidarDomicilio: true,
                minlength: 40
            },
            cedula_profesional:{
                required: true,
                ValidarCedula: true,
                minlength: 6,
                maxlength: 40
            },
            cedula_especialidad:{
                required: true,
                ValidarCedula: true,
                minlength: 6,
                maxlength: 40
            },
            correo:{
                required: true,
                ValidarCorreo: true
            },
            telefono:{
                required: true,
                ValidarTelefono: true,
                minlength: 10,
                maxlength: 10
            },
            password:{
                required: true,
                ValidarPassword: true
            },
            passwordCopy:{
                required: true,
                equalTo: "#password"
            },
            terminos:{
                required: true
            }
        },
        messages:{
            nombre:{
                required: 'Nombre es un campo requerido',
                minlength: 'El nombre debe contener por lo menos tres letras'
            },
            apellido_paterno:{
                required: 'Apellido paterno es un campo requerido',
                minlength: 'El apellido paterno debe contener por lo menos tres letras'
            },
            apellido_materno:{
                required: 'Apellido materno es un campo requerido',
                minlength: 'El apellido materno debe contener por lo menos tres letras'
            },
            domicilio:{
                required: 'Domicilio es un campo requerido',
                minlength: 'El domicilio es muy corto'
            },
            cedula_profesional:{
                required: 'Cédula profesional es un campo requerido',
                minlength: 'La cédula profesional debe contener por lo menos 6 caracteres',
                maxlength: 'La cédula profesional debe contener máximo 40 caracteres'
            },
            cedula_especialidad:{
                required: 'Cédula de especialidad es un campo requerido',
                minlength: 'La cédula de especialidad debe contener por lo menos 6 caracteres',
                maxlength: 'La cédula de especialidad debe contener máximo 40 caracteres'
            },
            correo:{
                required: 'Correo electrónico es un campo requerido'
            },
            telefono:{
                required: 'Teléfono es un campo requerido',
                minlength: 'El teléfono debe contener 10 dígitos',
                maxlength: 'El teléfono debe contener 10 dígitos'
            },
            password:{
                required: 'Contraseña es un campo requerido'
            },
            passwordCopy:{
                required: 'Copia de la contraseña es un campo requerido',
                equalTo: 'Las contraseñas no coinciden'
            },
            terminos:{
                required: 'Terminos y condiciones es un campo requerido'
            }
        }
    });


    $("#login").validate({
        rules:{
            usuario:{
                required: true,
                ValidarUsuario: true
            },
            password:{
                required: true
            }
        },
        messages:{
            usuario:{
                required: 'El correo electrónico o teléfono es un campo requerido',
            },
            password:{
                required: 'Contraseña es un campo requerido'
            }
        }
    });

    $("#registro-secretaria").validate({
        errorPlacement: function(error, element){
            if (element.attr('type') == 'checkbox'){
                error.insertAfter(element.parent('label').parent('div').parent('div'));
            }
            else{
                error.insertAfter(element);
            }
        },
        rules:{
            nombre:{
                required: true,
                ValidarNombre: true,
                minlength: 3
            },
            apellido_paterno:{
                required: true,
                ValidarApellidoPaterno: true,
                minlength: 3
            },
            apellido_materno:{
                required: true,
                ValidarApellidoMaterno: true,
                minlength: 3
            },
            domicilio:{
                required: true,
                ValidarDomicilio: true,
                minlength: 40
            },
            correo:{
                required: true,
                ValidarCorreo: true
            },
            telefono:{
                required: true,
                ValidarTelefono: true,
                minlength: 10,
                maxlength: 10
            },
            password:{
                required: true,
                ValidarPassword: true
            },
            passwordCopy:{
                required: true,
                equalTo: "#password"
            },
            terminos:{
                required: true
            }
        },
        messages:{
            nombre:{
                required: 'Nombre es un campo requerido',
                minlength: 'El nombre debe contener por lo menos tres letras'
            },
            apellido_paterno:{
                required: 'Apellido paterno es un campo requerido',
                minlength: 'El apellido paterno debe contener por lo menos tres letras'
            },
            apellido_materno:{
                required: 'Apellido materno es un campo requerido',
                minlength: 'El apellido materno debe contener por lo menos tres letras'
            },
            domicilio:{
                required: 'Domicilio es un campo requerido',
                minlength: 'El domicilio es muy corto'
            },
            correo:{
                required: 'Correo electrónico es un campo requerido'
            },
            telefono:{
                required: 'Teléfono es un campo requerido',
                minlength: 'El teléfono debe contener 10 dígitos',
                maxlength: 'El teléfono debe contener 10 dígitos'
            },
            password:{
                required: 'Contraseña es un campo requerido'
            },
            passwordCopy:{
                required: 'Copia de la contraseña es un campo requerido',
                equalTo: 'Las contraseñas no coinciden'
            },
            terminos:{
                required: 'Terminos y condiciones es un campo requerido'
            }
        }
    });


    $("#registro-paciente").validate({
        rules:{
            nombre:{
                required: true,
                ValidarNombre: true,
                minlength: 3
            },
            apellido_paterno:{
                required: true,
                ValidarApellidoPaterno: true,
                minlength: 3
            },
            apellido_materno:{
                required: true,
                ValidarApellidoMaterno: true,
                minlength: 3
            },
            fecha_nacimiento:{
                required: true
            },
            alergias:{
                ValidarDomicilio: true,
                maxlength: 510
            }
            
        },
        messages:{
            nombre:{
                required: 'Nombre es un campo requerido',
                minlength: 'El nombre debe contener por lo menos tres letras'
            },
            apellido_paterno:{
                required: 'Apellido paterno es un campo requerido',
                minlength: 'El apellido paterno debe contener por lo menos tres letras'
            },
            apellido_materno:{
                required: 'Apellido materno es un campo requerido',
                minlength: 'El apellido materno debe contener por lo menos tres letras'
            },
            fecha_nacimiento:{
                required: 'La fecha de nacimiento es un campo requerido'
            },
            alergias:{
                maxlength: 'La longitud máxima para alergias es de 510 letras'
            }
        }
    });

    

    $("#registro-antecente-patologico").validate({
        rules:{
            padecimiento:{
                required: true,
                ValidarPadecimiento: true,
                minlength: 5,
                maxlength: 250
            },
            duracion:{
                required: true,
                ValidarDuracion: true,
                minlength: 5,
                maxlength: 60
            },
            fecha:{
                required: true,
            },
            tratamiento:{
                required: true,
                ValidarTratamiento: true,
                minlength: 5,
                maxlength: 250
            },
            descripcion:{
                ValidarDomicilio: true,
                ValidarDescripcion: true,
                maxlength: 510
            }
            
        },
        messages:{
            padecimiento:{
                required: 'El padecimiento es un campo requerido',
                minlength: 'El padecimiento debe contener por lo menos 5 letras',
                maxlength: 'El padecimiento debe contener máximo 250 letras'
            },
            duracion:{
                required: 'La duración es un campo requerido',
                minlength: 'La duración debe contener por lo menos 5 letras',
                maxlength: 'La duración debe contener máximo 60 letras'
            },
            fecha:{
                required: 'La fecha es un campo requerido'
            },
            tratamiento:{
                required: 'El tratamiento es un campo requerido',
                minlength: 'El tratamiento debe contener por lo menos 5 letras',
                maxlength: 'El tratamiento debe contener máximo 250 letras'
            },
            descripcion:{
                minlength: 'La descripción debe contener por lo menos  10 letras',
                maxlength: 'La descripción debe contener máximo 500 letras'
            }
        }
    });


    $("#registro-tutor").validate({
        rules:{
            nombre:{
                required: true,
                ValidarNombre: true,
                minlength: 3
            },
            apellido_paterno:{
                required: true,
                ValidarApellidoPaterno: true,
                minlength: 3
            },
            apellido_materno:{
                required: true,
                ValidarApellidoMaterno: true,
                minlength: 3
            },
            domicilio:{
                ValidarDomicilio: true,
                minlength: 40,
                maxlength: 250
            },
            correo:{
                ValidarCorreo: true
            },
            telefono:{
                ValidarTelefono: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages:{
            nombre:{
                required: 'Nombre es un campo requerido',
                minlength: 'El nombre debe contener por lo menos tres letras'
            },
            apellido_paterno:{
                required: 'Apellido paterno es un campo requerido',
                minlength: 'El apellido paterno debe contener por lo menos tres letras'
            },
            apellido_materno:{
                required: 'Apellido materno es un campo requerido',
                minlength: 'El apellido materno debe contener por lo menos tres letras'
            },
            domicilio:{
                minlength: 'El domicilio es muy corto',
                maxlength: 'El domicilio es muy largo'
            },
            telefono:{
                minlength: 'El teléfono debe contener 10 dígitos',
                maxlength: 'El teléfono debe contener 10 dígitos'
            }
        }
    });


});