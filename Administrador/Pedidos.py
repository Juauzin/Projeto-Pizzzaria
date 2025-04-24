import mysql.connector
from tkinter import Tk, Label, Button, font, Frame, Canvas, Scrollbar
from tkinter import messagebox

def consultaSQl():
    try:
        conexao = mysql.connector.connect(
            user="root",
            password="root",
            host="localhost",
            port="3306",
            database="pizzaria_radiante"
        )
        cursor = conexao.cursor()
        cursor.execute("SELECT * FROM pedidos")
        resultados = cursor.fetchall()
        colunas = [column[0] for column in cursor.description]

        # Limpa qualquer tabela anterior no canvas
        canvas.delete("all")
        tabela_frame_interno = Frame(canvas)

        # Cria os cabeçalhos da tabela
        for i, coluna in enumerate(colunas):
            header_label = Label(tabela_frame_interno, text=coluna, font=("Helvetica", 12, "bold"), relief="solid", bd=1)
            header_label.grid(row=0, column=i, padx=5, pady=5, sticky="ew")

        # Preenche os dados da tabela
        for i, linha in enumerate(resultados):
            for j, valor in enumerate(linha):
                data_label = Label(tabela_frame_interno, text=valor, relief="solid", bd=1)
                data_label.grid(row=i + 1, column=j, padx=5, pady=2, sticky="ew")

        # Atualiza a região de rolagem do canvas
        canvas.create_window((0, 0), window=tabela_frame_interno, anchor="nw")
        tabela_frame_interno.update_idletasks()
        canvas.config(scrollregion=canvas.bbox("all"))

    except mysql.connector.Error as err:
        mensagem = f"Erro ao conectar ou consultar o MySQL:\n{err}"
        messagebox.showerror("Erro", mensagem)
    finally:
        if 'conexao' in locals() and conexao.is_connected():
            cursor.close()
            conexao.close()
            print("Conexão com MySQL encerrada.")

janela = Tk()
janela.title("Consulta em Banco de Dados")
janela.geometry("600x400")

fonte_h2 = font.Font(family="Helvetica", size=16, weight="bold")
texto_inicial = Label(janela, text="VER PEDIDOS", font=fonte_h2)
texto_inicial.pack(pady=10)
botao_consultar = Button(janela, text="Mostrar Pedidos", command=consultaSQl)
botao_consultar.pack(pady=10)

# Canvas para conter a tabela com barras de rolagem
canvas = Canvas(janela)
canvas.pack(side="left", fill="both", expand=True)

# Barras de rolagem
scrollbar_vertical = Scrollbar(janela, orient="vertical", command=canvas.yview)
scrollbar_vertical.pack(side="right", fill="y")
scrollbar_horizontal = Scrollbar(canvas, orient="horizontal", command=canvas.xview)
scrollbar_horizontal.pack(side="bottom", fill="x")

# Configurar o canvas para usar as barras de rolagem
canvas.configure(yscrollcommand=scrollbar_vertical.set, xscrollcommand=scrollbar_horizontal.set)
canvas.bind('<Configure>', lambda e: canvas.configure(scrollregion=canvas.bbox("all")))

janela.mainloop()