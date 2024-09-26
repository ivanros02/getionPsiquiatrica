import tkinter as tk
from tkinter import ttk, filedialog, messagebox
from tkinter import PhotoImage
import pandas as pd
import pywhatkit as kit

def cargar_excel():
    numero_origen = entry_numero_origen.get()
    
    if not numero_origen:
        messagebox.showerror("Error", "Debes ingresar el número de origen.")
        return
    
    archivo = filedialog.askopenfilename(title="Selecciona el archivo Excel", filetypes=[("Archivos Excel", "*.xlsx")])
    if archivo:
        try:
            df = pd.read_excel(archivo)
            
            for index, row in df.iterrows():
                numero_destino = row['NUMERO']
                mensaje = f"Hola {row['PACIENTE']}, te recordamos tu turno con {row['PROFESIONAL']} el {row['FECHA']}."
                
                kit.sendwhatmsg_instantly(f"+549{numero_destino}", mensaje, wait_time=20)
            
            messagebox.showinfo("Éxito", "Mensajes enviados con éxito")
        
        except Exception as e:
            messagebox.showerror("Error", f"Error al cargar el archivo: {str(e)}")

# Interfaz gráfica con Tkinter
root = tk.Tk()
root.title("Enviar WhatsApp desde Excel")

# Tamaño de ventana
root.geometry("400x450")  # Ajuste del tamaño de la ventana

# Etiqueta y campo de entrada para el número de origen
lbl_numero_origen = tk.Label(root, text="Número de Origen:", font=('Arial', 12))
lbl_numero_origen.pack(pady=10)
entry_numero_origen = tk.Entry(root, font=('Arial', 12), width=30)
entry_numero_origen.pack(pady=10)

# Botón para cargar el Excel y enviar los mensajes
btn_cargar = tk.Button(root, text="Cargar Excel y Enviar Mensajes", font=('Arial', 12), bg="#3498db", fg="white", padx=10, pady=5, command=cargar_excel)
btn_cargar.pack(pady=20)

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
