import sys
import subprocess

def install(package):
    subprocess.check_call([sys.executable, "-m", "pip", "install", package])

try:
    from PIL import Image
except ImportError:
    install("Pillow")
    from PIL import Image

try:
    import numpy as np
except ImportError:
    install("numpy")
    import numpy as np

def remove_white_bg(input_path, output_path):
    img = Image.open(input_path).convert("RGBA")
    data = np.array(img)
    
    r, g, b, a = data[:,:,0], data[:,:,1], data[:,:,2], data[:,:,3]
    
    # Calculate average color
    avg_color = (r.astype(int) + g.astype(int) + b.astype(int)) / 3.0
    
    # Calculate saturation
    max_c = np.max(data[:,:,:3], axis=2)
    min_c = np.min(data[:,:,:3], axis=2)
    saturation = (max_c.astype(int) - min_c.astype(int))
    
    # Mask out white pixels (bright and low saturation)
    mask = (avg_color > 210) & (saturation < 30)
    
    # Soft alpha fade
    fade_alpha = (255 - avg_color) * (255 / 45.0)  # 255-210 = 45
    
    new_a = np.where(mask, fade_alpha, a)
    new_a = np.clip(new_a, 0, 255).astype(np.uint8)
    
    data[:,:,3] = new_a
    
    img_transparent = Image.fromarray(data)
    img_transparent.save(output_path, "PNG")

remove_white_bg(r"C:\xampp\htdocs\pelayanan psdkp\public\images\logo.png", r"C:\xampp\htdocs\pelayanan psdkp\public\images\logo.png")
print("Image processed successfully.")
