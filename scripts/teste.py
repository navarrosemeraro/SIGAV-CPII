import fitz  # PyMuPDF
import sys
import os

# Nome do PDF recebido via argumento
pdf_name = sys.argv[1]

# Caminho do PDF
input_path = os.path.join("pdfs_input", pdf_name)
output_path = os.path.join("pdfs_output", pdf_name.replace(".pdf", ".txt"))

# Abre o PDF
doc = fitz.open(input_path)

# Extrai o texto de todas as páginas
texto = ""
for pagina in doc:
    texto += pagina.get_text()

# Salva em arquivo .txt
with open(output_path, "w", encoding="utf-8") as f:
    f.write(texto)

print("Texto extraído com sucesso em", output_path)
print("Número de páginas:", doc.page_count)
print(texto)