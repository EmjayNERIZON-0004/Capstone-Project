<style>
         body {
         
            /* background: linear-gradient(to right,rgba(86, 96, 106, 0.4),rgba(7, 52, 88, 0.38)); */
            background-color:rgb(133, 133, 133);

     } 
     .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
     .card {
         max-width: 900px;
         margin: auto;
         border: none;
     }

    .logo{
        width: 140px;
        margin-right: 10px;
    }
     .card-header {
         background-color: rgb(4, 59, 125);
         color: white;
         font-weight: bold;
         text-align: center;
     }
     .btn-custom {
         background-color: rgb(4, 59, 125);
         color: white;
     } .card {
            max-width: 900px;
            margin: auto;
            border: none;
        }
        button[type="submit"] {
    background-color: rgb(4, 59, 125); /* Dark Blue Background */
     
}
.header-text{
        font-size:30px;
    }
/* Hover Effect */
button[type="submit"]:hover {
    background-color: rgb(3, 45, 95); /* Darker Blue on Hover */
    color: white;
}

@media (max-width: 900px) {
    .card-header {
        flex-direction: row; /* Keep it side by side */
        justify-content: flex-start; /* Align left */
    }

    .logo {
       width: 60px;
        height: auto;
        max-width: 100px; /* Slightly smaller logo */
    }

    .header-text {
        font-size: 14px; /* Reduce text size but keep readable */
    }

    h4 {
        font-size: 12px; /* Adjust subtitle text */
    }
}
@media (max-width: 600px) {
    .card-header {
        flex-direction: column; /* Stack elements */
        align-items: center;
        text-align: center;
    }

    .logo {
        max-width: 120px; /* Reduce logo size */
        margin-bottom: 10px;        
    }

    .header-text {
        font-size: 1.4rem;
    }

    .sub-text {
        font-size: 1rem;
    }
} 
/* .card {
    opacity: 0;
      animation: fadeInUp 4s ease-out forwards;
}
 
@keyframes fadeInUp {
    to {
        opacity: 1;
         }
}  */
</style>