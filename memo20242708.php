diff --git a/app/Http/Controllers/FuturoJubiladoController.php b/app/Http/Controllers/FuturoJubiladoController.php
index da71790..d4c52cc 100644
--- a/app/Http/Controllers/FuturoJubiladoController.php
+++ b/app/Http/Controllers/FuturoJubiladoController.php
@@ -296,7 +296,8 @@ public function seguimientoUsuarios($m4user)
             $persona->observaciones .= "\nFecha: " . $fechaHoy . "\n";
     
             // Guardar los cambios en la base de datos
-            $persona->save();
+            // $persona->save();
+            // NO GUARDAR
         }
     
         // Retornar los datos en formato JSON
diff --git a/resources/views/futurojubilado/index.blade.php b/resources/views/futurojubilado/index.blade.php
index cf99565..a53439a 100644
--- a/resources/views/futurojubilado/index.blade.php
+++ b/resources/views/futurojubilado/index.blade.php
@@ -314,7 +314,7 @@
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="seguimientoModalLabel">Seguimiento de Usuario: <span id="modalUsuario"></span></h5>
-                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
+                <button type="button" class="close" data-dismiss="modal" style="display:none;" aria-label="Cerrar">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
@@ -330,13 +330,17 @@
 
                     <div class="form-group">
                         <button type="submit" class="btn btn-primary">Guardar Seguimiento</button>
+                        <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>                        
                     </div>
+
+                    
+                    
+                    
+
                 </form>
             </div>
-        <!-- Botón de Cancelar dentro del Modal -->
-        <div class="modal-footer">
-            <button type="button" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
-        </div>
+            <!-- Botón de Cancelar dentro del Modal -->
+
 
 
         </div>
@@ -565,11 +569,11 @@ function openSeguimientoModal() {
                 },
                 error: function(xhr) {
                     // Manejo de errores
-                    console.error('Error al obtener los datos:', xhr);
+                    alert('Por favor registre al usuario en una Institución / Oficina');
                 }
             });
         } else {
-            console.error('Usuario no encontrado en la URL');
+            alert('Seleccione un usuario por favor');
         }
     }
 </script>
@@ -578,7 +582,7 @@ function openSeguimientoModal() {
     document.getElementById('btnCancelar').addEventListener('click', function() {
         // Obtén el modal abierto actualmente
         var modal = document.querySelector('.modal.show');
-        
+
         if (modal) {
             // Simula la acción de presionar la tecla ESC
             $(modal).modal('hide');
