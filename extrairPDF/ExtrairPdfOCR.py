import pytesseract
from PIL import Image

from PIL import Image
import pytesseract
pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
lista=[]
lista = pytesseract.image_to_string(Image.open('imagem-000001.png')).split()
print("teste") 
