import os
from PIL import Image

def create_mobile_images(directory):
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.lower().endswith(('.jpg', '.jpeg', '.png', '.webp')):
                filepath = os.path.join(root, file)
                filename, ext = os.path.splitext(file)
                
                # Check if this is a mobile image already
                if filename.endswith('-mobile'):
                    continue
                
                # We only care about hero images for now, or large images
                # Let's filter by size or path if needed, but for now specific hero images
                if "hero" not in filename.lower() and "Depositphotos" not in filename: 
                    # specific check for known hero images from hero_2.blade.php
                    if "personalized-care" not in filename and "happy-seniors" not in filename:
                        continue

                try:
                    with Image.open(filepath) as img:
                        if img.width > 768:
                            ratio = 768 / img.width
                            new_height = int(img.height * ratio)
                            img_mobile = img.resize((768, new_height), Image.Resampling.LANCZOS)
                            
                            mobile_filepath = os.path.join(root, f"{filename}-mobile{ext}")
                            img_mobile.save(mobile_filepath, optimize=True, quality=80)
                            print(f"Created mobile version: {mobile_filepath}")
                except Exception as e:
                    print(f"Error processing {filepath}: {e}")

if __name__ == "__main__":
    base_dir = r"d:\Creatx Software\Project\Care365\care365\public\assets\img\Home-img"
    create_mobile_images(base_dir)
