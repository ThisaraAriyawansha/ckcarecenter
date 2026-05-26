
import os
from PIL import Image

def optimize_images(directory):
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.lower().endswith(('.jpg', '.jpeg', '.png')):
                filepath = os.path.join(root, file)
                filename, ext = os.path.splitext(file)
                
                # specific checks based on lighthouse report
                
                # 1. Logo
                if "logo.png" in file.lower():
                     try:
                        with Image.open(filepath) as img:
                            # Resize logo if needed (Lighthouse said 1000x731 is too big for 82x60)
                            # Let's resize to a reasonable max width, say 200px
                            if img.width > 200:
                                ratio = 200 / img.width
                                new_height = int(img.height * ratio)
                                img = img.resize((200, new_height), Image.Resampling.LANCZOS)
                                
                            webp_path = os.path.join(root, f"{filename}.webp")
                            img.save(webp_path, 'WEBP', optimize=True, quality=90)
                            print(f"Optimized Logo: {webp_path}")
                     except Exception as e:
                        print(f"Error processing logo {filepath}: {e}")
                        
                # 2. PHSRC Badge
                elif "PHSRC" in file and "mobile" not in file.lower():
                     try:
                        with Image.open(filepath) as img:
                            # Lighthouse said 225x224 is too big for 50x50
                            if img.width > 100: # resize to double the display size for retina
                                img = img.resize((100, 100), Image.Resampling.LANCZOS)
                            
                            webp_path = os.path.join(root, f"{filename}.webp")
                            img.save(webp_path, 'WEBP', optimize=True, quality=90)
                            print(f"Optimized PHSRC: {webp_path}")
                     except Exception as e:
                        print(f"Error processing PHSRC {filepath}: {e}")

                # 3. Hero images and others in Home-img
                elif "Home-img" in root:
                    try:
                        with Image.open(filepath) as img:
                            # Convert to WebP
                            webp_path = os.path.join(root, f"{filename}.webp")
                            # Don't overwrite if exists
                            if not os.path.exists(webp_path):
                                img.save(webp_path, 'WEBP', optimize=True, quality=80)
                                print(f"Converted to WebP: {webp_path}")
                    except Exception as e:
                        print(f"Error processing {filepath}: {e}")

                # 4. Service Images (care_homes_img, services_img)
                elif "care_homes_img" in root or "services_img" in root:
                     try:
                        with Image.open(filepath) as img:
                            # Lighthouse mentioned these are too large.
                            # displayed ~500x280. Max width needed ~600-800 checking
                            if img.width > 800:
                                ratio = 800 / img.width
                                new_height = int(img.height * ratio)
                                img = img.resize((800, new_height), Image.Resampling.LANCZOS)
                            
                            webp_path = os.path.join(root, f"{filename}.webp")
                            # force overwrite or check if webp is smaller/exists
                            img.save(webp_path, 'WEBP', optimize=True, quality=80)
                            print(f"Optimized Service/CareHome Img: {webp_path}")
                     except Exception as e:
                        print(f"Error processing {filepath}: {e}")

                # 5. Other large assets (Video poster, About, Icons)
                elif "assets\\images" in root or "assets/images" in root:
                    try:
                        with Image.open(filepath) as img:
                            # About Landing Page is ~500kb. Resize if huge.
                            if "Landing Page" in filename and img.width > 1200:
                                 ratio = 1200 / img.width
                                 new_height = int(img.height * ratio)
                                 img = img.resize((1200, new_height), Image.Resampling.LANCZOS)
                            
                            # Icons - keep size but convert to webp
                            
                            webp_path = os.path.join(root, f"{filename}.webp")
                            if not os.path.exists(webp_path):
                                img.save(webp_path, 'WEBP', optimize=True, quality=85)
                                print(f"Optimized Asset: {webp_path}")
                    except Exception as e:
                        print(f"Error processing asset {filepath}: {e}")

if __name__ == "__main__":
    base_dir = r"d:\Creatx Software\Project\Care365\care365\public"
    optimize_images(base_dir)
