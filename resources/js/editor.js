import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header'; 
import List from '@editorjs/list'; 
import Paragraph from '@editorjs/paragraph';
import ImageTool from '@editorjs/image';



document.addEventListener('DOMContentLoaded', () => {
    const editor = new EditorJS({
        holder: 'editorjs', // The ID of the element where Editor.js will be mounted
        tools: {
            header: {
                class: Header,
                inlineToolbar: ['link'],
            },
            list: {
                class: List,
                inlineToolbar: true,
            },
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        // Endpoint for uploading images
                        byFile: '/upload-image', // Your backend route for handling file uploads
                        // Endpoint for using image URLs
                        byUrl: '/storage/uploads/', // Optional: Your backend route for fetching images by URL
                    },
                    additionalRequestHeaders: {
                        // If needed, e.g., for CSRF tokens
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }
            }
        },
    });
});