import tkinter as tk
from tkinter import ttk, filedialog, messagebox
from tkinter import PhotoImage
import pandas as pd
import pywhatkit as kit

# Variable para controlar el estado de la pestaña
current_message_index = 0

# Función para cargar el archivo Excel y enviar mensajes de recordatorio
def cargar_excel():
    numero_origen = entry_numero_origen.get()
    
    if not numero_origen:
        messagebox.showerror("Error", "Debes ingresar el número de origen.")
        return
    
    archivo = filedialog.askopenfilename(title="Selecciona el archivo Excel", filetypes=[("Archivos Excel", "*.xlsx")])
    if archivo:
        try:
            df = pd.read_excel(archivo)
            wait_time = get_wait_time()  # Obtener el tiempo de espera seleccionado
            
            for index, row in df.iterrows():
                numero_destino = row['NUMERO']
                mensaje = f"Hola {row['PACIENTE']}, te recordamos tu turno con {row['PROFESIONAL']} el {row['FECHA']}."
                
                # Envía el mensaje
                kit.sendwhatmsg_instantly(f"+549{numero_destino}", mensaje, wait_time=wait_time)
                
            messagebox.showinfo("Éxito", "Mensajes enviados con éxito")
        
        except Exception as e:
            messagebox.showerror("Error", f"Error al cargar el archivo: {str(e)}")

# Función para cargar el archivo Excel y enviar mensajes de cancelación
def enviar_cancelaciones():
    numero_origen = entry_numero_origen.get()
    
    if not numero_origen:
        messagebox.showerror("Error", "Debes ingresar el número de origen.")
        return
    
    archivo = filedialog.askopenfilename(title="Selecciona el archivo Excel", filetypes=[("Archivos Excel", "*.xlsx")])
    if archivo:
        try:
            df = pd.read_excel(archivo)
            wait_time = get_wait_time()  # Obtener el tiempo de espera seleccionado
            
            for index, row in df.iterrows():
                numero_destino = row['NUMERO']
                mensaje = f"Hola {row['PACIENTE']}, te informamos que tu turno con {row['PROFESIONAL']} del {row['FECHA']} ha sido cancelado."
                
                # Envía el mensaje
                kit.sendwhatmsg_instantly(f"+549{numero_destino}", mensaje, wait_time=wait_time)
                
            messagebox.showinfo("Éxito", "Mensajes de cancelación enviados con éxito")
        
        except Exception as e:
            messagebox.showerror("Error", f"Error al cargar el archivo: {str(e)}")

# Función para obtener el tiempo de espera según la selección
def get_wait_time():
    selection = combo_wait_time.get()
    if selection == "PC Gama Baja":
        return 40
    elif selection == "PC Gama Media":
        return 20
    elif selection == "PC Gama Alta":
        return 10  # Puedes ajustar este valor
    return 20  # Valor por defecto

# Interfaz gráfica con Tkinter
root = tk.Tk()
root.title("Recordatorio Medical")

# Tamaño de ventana
root.geometry("400x500")  # Ajuste del tamaño de la ventana

# Etiqueta y campo de entrada para el número de origen
lbl_numero_origen = tk.Label(root, text="Número de Origen:", font=('Arial', 12))
lbl_numero_origen.pack(pady=10)
entry_numero_origen = tk.Entry(root, font=('Arial', 12), width=30)
entry_numero_origen.pack(pady=10)

# Etiqueta y combobox para seleccionar el tiempo de espera
lbl_wait_time = tk.Label(root, text="Selecciona el tiempo de espera:", font=('Arial', 12))
lbl_wait_time.pack(pady=10)

# Combobox para tiempos de espera
combo_wait_time = ttk.Combobox(root, font=('Arial', 12), state='readonly')
combo_wait_time['values'] = ("PC Gama Baja", "PC Gama Media", "PC Gama Alta")
combo_wait_time.current(1)  # Selecciona por defecto "PC Gama Media"
combo_wait_time.pack(pady=10)

# Botón para cargar el Excel y enviar los mensajes
btn_cargar = tk.Button(root, text="Cargar Excel y Enviar Mensajes", font=('Arial', 12), bg="#3498db", fg="white", padx=10, pady=5, command=cargar_excel)
btn_cargar.pack(pady=20)

# Botón para cargar el Excel y enviar mensajes de cancelación
btn_cancelar = tk.Button(root, text="Cargar Excel y Enviar Cancelaciones", font=('Arial', 12), bg="#e74c3c", fg="white", padx=10, pady=5, command=enviar_cancelaciones)
btn_cancelar.pack(pady=20)

# Cargar y añadir logo debajo del botón
try:
    logo = PhotoImage(file="logo.png")  # Reemplaza con la ruta a tu logo
    logo_label = tk.Label(root, image=logo)
    logo_label.pack(pady=10)
except:
    logo_label = tk.Label(root, text="Logo no encontrado", font=('Arial', 12), fg="red")
    logo_label.pack(pady=10)

# Ejecutar la ventana de Tkinter
root.mainloop()
