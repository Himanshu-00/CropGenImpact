import re

def comment_out_css_blocks(input_file, output_file):
    with open(input_file, 'r') as file:
        css_content = file.read()
    
    # Regex to find CSS blocks
    css_blocks = re.findall(r'(\.[\w-]+\s*{[^}]*})', css_content, re.DOTALL)
    
    for block in css_blocks:
        commented_block = f"/* {block} */"
        css_content = css_content.replace(block, commented_block)
    
    with open(output_file, 'w') as file:
        file.write(css_content)

# Usage
input_css_file = '/Users/himanshuvinchurkar/Downloads/CropGenImpact/api.css'  # Replace with your input file path
output_css_file = '/Users/himanshuvinchurkar/Downloads/CropGenImpact/api.css'  # Replace with your output file path

comment_out_css_blocks(input_css_file, output_css_file)
