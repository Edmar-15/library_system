// // document.addEventListener("DOMContentLoaded", () => {
    
// //     const book = document.getElementById("book");

// //     // OPEN BOOK ON LOAD
// //     book.style.transform = "rotateY(90deg)";

// //     setTimeout(() => {
// //         book.style.transform = "rotateY(0deg)";
// //     }, 300);

// //     // FUNCTION: close book then go to page
// //     function closeBookAndGo(url) {
// //         book.style.transition = "transform 0.9s ease-in-out";
// //         book.style.transform = "rotateY(90deg)";

// //         setTimeout(() => {
// //             window.location.href = url;
// //         }, 900); // same as transition duration
// //     }

// //     // REGISTER BUTTON ---------------------------
// //     const registerBtn = document.getElementById("registerBtn");
// //     registerBtn.addEventListener("click", () => {
// //         const url = registerBtn.getAttribute("data-link");
// //         closeBookAndGo(url);
// //     });

// //     // LOGIN BUTTON ------------------------------
// //     const loginBtn = document.getElementById("loginBtn");
// //     loginBtn.addEventListener("click", () => {
// //         const url = loginBtn.getAttribute("data-link");
// //         closeBookAndGo(url);
// //     });

// // });

// import React, { useState } from 'react';

// export default function LibrarySystem() {
//   const [currentPage, setCurrentPage] = useState('home');
//   const [isOpening, setIsOpening] = useState(false);
//   const [email, setEmail] = useState('');
//   const [password, setPassword] = useState('');
//   const [confirmPassword, setConfirmPassword] = useState('');

//   const openBook = (page) => {
//     setIsOpening(true);
//     setTimeout(() => {
//       setCurrentPage(page);
//       setIsOpening(false);
//     }, 800);
//   };

//   const handleLogin = () => {
//     alert('Login functionality - Email: ' + email);
//   };

//   const handleRegister = () => {
//     if (password !== confirmPassword) {
//       alert('Passwords do not match!');
//       return;
//     }
//     alert('Registration successful!');
//   };

//   const handleForgotPassword = () => {
//     alert('Password reset link sent to: ' + email);
//   };

//   return (
//     <div style={{ margin: 0, padding: 0, fontFamily: 'Arial, Helvetica, sans-serif', boxSizing: 'border-box' }}>
//       <style>{`
//         @keyframes openBook {
//           0% {
//             transform: perspective(2000px) rotateY(0deg);
//           }
//           100% {
//             transform: perspective(2000px) rotateY(-180deg);
//           }
//         }

//         @keyframes closeBook {
//           0% {
//             transform: perspective(2000px) rotateY(-180deg);
//           }
//           100% {
//             transform: perspective(2000px) rotateY(0deg);
//           }
//         }

//         .book-opening .left-page {
//           animation: openBook 0.8s ease-in-out forwards;
//           transform-origin: right center;
//         }

//         * {
//           margin: 0;
//           padding: 0;
//           box-sizing: border-box;
//         }
//       `}</style>
      
//       <div style={{
//         background: '#dfb87d',
//         minHeight: '100vh',
//         display: 'flex',
//         flexDirection: 'column',
//       }}>
//         {/* Header */}
//         <header style={{
//           background: '#d98c19',
//           padding: '20px 40px',
//           boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
//           textAlign: 'left',
//           color: '#ffffff',
//         }}>
//           <h1 style={{ margin: 0, fontSize: '28px', cursor: 'pointer' }} onClick={() => openBook('home')}>
//             {currentPage === 'home' ? 'LibrarySystem' : 'Library System'}
//           </h1>
//         </header>

//         {/* Container */}
//         <div style={{
//           flex: 1,
//           width: '100%',
//           display: 'flex',
//           justifyContent: 'center',
//           alignItems: 'center',
//           padding: '40px 20px',
//           perspective: '2000px',
//         }}>
//           {/* HOME PAGE - CLOSED BOOK */}
//           {currentPage === 'home' && (
//             <div className={isOpening ? 'book-opening' : ''} style={{
//               display: 'flex',
//               position: 'relative',
//               maxWidth: '900px',
//               width: '100%',
//               margin: '0 auto',
//               transformStyle: 'preserve-3d',
//             }}>
//               {/* Left Page - White */}
//               <div className="left-page" style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#fff',
//                 borderRadius: '20px 0 0 20px',
//                 boxShadow: '-10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//                 alignItems: 'center',
//                 padding: '50px',
//                 position: 'relative',
//                 transformStyle: 'preserve-3d',
//                 backfaceVisibility: 'hidden',
//               }}>
//                 <div style={{ fontSize: '72px', marginBottom: '30px', color: '#d98c19' }}>
//                   📚
//                 </div>
//                 <div style={{
//                   fontSize: '28px',
//                   color: '#333',
//                   marginBottom: '15px',
//                   textAlign: 'center',
//                   fontWeight: 'bold',
//                 }}>
//                   Welcome to Our Digital Library
//                 </div>
//                 <div style={{
//                   fontSize: '16px',
//                   color: '#666',
//                   textAlign: 'center',
//                   lineHeight: '1.6',
//                   fontWeight: 'normal',
//                 }}>
//                   Access thousands of books, journals, and resources from anywhere, anytime. Join our community of readers and learners today.
//                 </div>
//               </div>

//               {/* Right Page - Orange */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#d98c19',
//                 borderRadius: '0 20px 20px 0',
//                 boxShadow: '10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 padding: '50px',
//                 color: 'white',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//                 position: 'relative',
//               }}>
//                 <h1 style={{
//                   margin: 0,
//                   fontSize: '42px',
//                   fontWeight: 'bold',
//                   color: 'white',
//                   marginBottom: '20px',
//                 }}>
//                   Welcome Back!
//                 </h1>
//                 <div style={{
//                   fontSize: '18px',
//                   marginBottom: '40px',
//                   lineHeight: '1.6',
//                   fontWeight: 'normal',
//                 }}>
//                   Sign in to access your personal library, continue reading, or register to explore our vast collection of resources.
//                 </div>

//                 <div style={{
//                   display: 'flex',
//                   flexDirection: 'column',
//                   gap: '20px',
//                   marginTop: '20px',
//                 }}>
//                   <button
//                     onClick={() => openBook('register')}
//                     style={{
//                       padding: '15px 40px',
//                       borderRadius: '30px',
//                       fontWeight: 'bold',
//                       transition: 'all 0.3s ease',
//                       background: 'white',
//                       color: '#d98c19',
//                       border: '3px solid white',
//                       cursor: 'pointer',
//                       fontSize: '18px',
//                     }}
//                     onMouseOver={(e) => {
//                       e.target.style.transform = 'translateY(-3px)';
//                       e.target.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.3)';
//                       e.target.style.background = '#f5f5f5';
//                     }}
//                     onMouseOut={(e) => {
//                       e.target.style.transform = 'translateY(0)';
//                       e.target.style.boxShadow = 'none';
//                       e.target.style.background = 'white';
//                     }}
//                   >
//                     Register
//                   </button>
//                   <button
//                     onClick={() => openBook('login')}
//                     style={{
//                       padding: '15px 40px',
//                       borderRadius: '30px',
//                       fontWeight: 'bold',
//                       transition: 'all 0.3s ease',
//                       background: 'transparent',
//                       color: 'white',
//                       border: '3px solid white',
//                       cursor: 'pointer',
//                       fontSize: '18px',
//                     }}
//                     onMouseOver={(e) => {
//                       e.target.style.transform = 'translateY(-3px)';
//                       e.target.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.3)';
//                       e.target.style.background = 'rgba(255, 255, 255, 0.1)';
//                     }}
//                     onMouseOut={(e) => {
//                       e.target.style.transform = 'translateY(0)';
//                       e.target.style.boxShadow = 'none';
//                       e.target.style.background = 'transparent';
//                     }}
//                   >
//                     Login
//                   </button>
//                 </div>
//               </div>

//               {/* Book Spine */}
//               <div style={{
//                 position: 'absolute',
//                 left: '50%',
//                 transform: 'translateX(-50%)',
//                 width: '20px',
//                 height: '500px',
//                 background: 'linear-gradient(to right, #8B4513 0%, #654321 50%, #8B4513 100%)',
//                 boxShadow: 'inset 0 0 10px rgba(0,0,0,0.5)',
//                 zIndex: 2,
//               }}></div>
//             </div>
//           )}

//           {/* LOGIN PAGE - OPEN BOOK */}
//           {currentPage === 'login' && (
//             <div style={{
//               display: 'flex',
//               position: 'relative',
//               maxWidth: '900px',
//               width: '100%',
//               margin: '0 auto',
//             }}>
//               {/* Left Page - White */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#fff',
//                 borderRadius: '20px 0 0 20px',
//                 boxShadow: '-10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//                 alignItems: 'center',
//                 padding: '50px',
//               }}>
//                 <div style={{ fontSize: '72px', marginBottom: '20px', color: '#d98c19' }}>
//                   📖
//                 </div>
//                 <div style={{
//                   fontSize: '24px',
//                   color: '#333',
//                   textAlign: 'center',
//                   fontWeight: 'normal',
//                   lineHeight: '1.5',
//                 }}>
//                   Enter your credentials to access your library
//                 </div>
//               </div>

//               {/* Right Page - Orange with Form */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#EB9D2E',
//                 borderRadius: '0 20px 20px 0',
//                 boxShadow: '10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 padding: '50px',
//                 color: 'white',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//               }}>
//                 <label style={{ fontWeight: '500', color: 'whitesmoke', marginBottom: '5px', fontSize: '14px' }}>
//                   Enter Email
//                 </label>
//                 <input
//                   type="email"
//                   value={email}
//                   onChange={(e) => setEmail(e.target.value)}
//                   style={{
//                     fontWeight: 'normal',
//                     outline: 'none',
//                     width: '100%',
//                     border: 'none',
//                     height: '45px',
//                     padding: '10px 20px',
//                     borderRadius: '50px',
//                     marginBottom: '20px',
//                     fontSize: '14px',
//                   }}
//                 />

//                 <label style={{ fontWeight: '500', color: 'whitesmoke', marginBottom: '5px', fontSize: '14px' }}>
//                   Enter password
//                 </label>
//                 <input
//                   type="password"
//                   value={password}
//                   onChange={(e) => setPassword(e.target.value)}
//                   style={{
//                     fontWeight: 'normal',
//                     outline: 'none',
//                     width: '100%',
//                     border: 'none',
//                     height: '45px',
//                     padding: '10px 20px',
//                     borderRadius: '50px',
//                     marginBottom: '10px',
//                     fontSize: '14px',
//                   }}
//                 />

//                 <a
//                   href="#"
//                   onClick={(e) => {
//                     e.preventDefault();
//                     openBook('forgot');
//                   }}
//                   style={{
//                     fontWeight: 'normal',
//                     fontSize: '12px',
//                     marginBottom: '20px',
//                     color: 'whitesmoke',
//                     textDecoration: 'none',
//                   }}
//                 >
//                   Forgot password?
//                 </a>

//                 <button
//                   onClick={handleLogin}
//                   style={{
//                     backgroundColor: '#FFFFFF',
//                     fontWeight: 'bold',
//                     border: 'none',
//                     borderRadius: '50px',
//                     padding: '12px',
//                     cursor: 'pointer',
//                     fontSize: '16px',
//                     marginBottom: '15px',
//                   }}
//                   onMouseOver={(e) => {
//                     e.target.style.boxShadow = '0px 0px 10px 4px rgba(0,0,0,0.2)';
//                   }}
//                   onMouseOut={(e) => {
//                     e.target.style.boxShadow = 'none';
//                   }}
//                 >
//                   Login
//                 </button>

//                 <p style={{ fontWeight: '600', textAlign: 'center', fontSize: '12px', color: 'whitesmoke' }}>
//                   Don't have an account?{' '}
//                   <a
//                     href="#"
//                     onClick={(e) => {
//                       e.preventDefault();
//                       openBook('register');
//                     }}
//                     style={{ textDecoration: 'none', color: '#4E95FF' }}
//                   >
//                     create account
//                   </a>
//                 </p>

//                 <div style={{
//                   color: 'whitesmoke',
//                   display: 'flex',
//                   alignItems: 'center',
//                   textAlign: 'center',
//                   margin: '15px 0 0 0',
//                   fontSize: '12px',
//                 }}>
//                   <div style={{ flex: 1, borderBottom: '1px solid #FFFF', margin: '0 10px' }}></div>
//                   Or log in with
//                   <div style={{ flex: 1, borderBottom: '1px solid #FFFF', margin: '0 10px' }}></div>
//                 </div>
//               </div>

//               {/* Book Spine */}
//               <div style={{
//                 position: 'absolute',
//                 left: '50%',
//                 transform: 'translateX(-50%)',
//                 width: '20px',
//                 height: '500px',
//                 background: 'linear-gradient(to right, #8B4513 0%, #654321 50%, #8B4513 100%)',
//                 boxShadow: 'inset 0 0 10px rgba(0,0,0,0.5)',
//                 zIndex: 2,
//               }}></div>
//             </div>
//           )}

//           {/* REGISTER PAGE - OPEN BOOK */}
//           {currentPage === 'register' && (
//             <div style={{
//               display: 'flex',
//               position: 'relative',
//               maxWidth: '900px',
//               width: '100%',
//               margin: '0 auto',
//             }}>
//               {/* Left Page - White */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#fff',
//                 borderRadius: '20px 0 0 20px',
//                 boxShadow: '-10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//                 alignItems: 'center',
//                 padding: '50px',
//               }}>
//                 <div style={{ fontSize: '72px', marginBottom: '20px', color: '#d98c19' }}>
//                   ✍️
//                 </div>
//                 <div style={{
//                   fontSize: '24px',
//                   color: '#333',
//                   textAlign: 'center',
//                   fontWeight: 'normal',
//                   lineHeight: '1.5',
//                 }}>
//                   Create your account and start your reading journey
//                 </div>
//               </div>

//               {/* Right Page - Orange with Form */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#EB9D2E',
//                 borderRadius: '0 20px 20px 0',
//                 boxShadow: '10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 padding: '50px',
//                 color: 'white',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//               }}>
//                 <h1 style={{
//                   fontSize: '36px',
//                   color: 'whitesmoke',
//                   marginBottom: '25px',
//                   textAlign: 'center',
//                 }}>
//                   Register
//                 </h1>

//                 <label style={{ fontWeight: '500', color: 'whitesmoke', marginBottom: '5px', fontSize: '14px' }}>
//                   Enter Email
//                 </label>
//                 <input
//                   type="email"
//                   value={email}
//                   onChange={(e) => setEmail(e.target.value)}
//                   style={{
//                     fontWeight: 'normal',
//                     outline: 'none',
//                     width: '100%',
//                     border: 'none',
//                     height: '40px',
//                     padding: '10px 20px',
//                     borderRadius: '50px',
//                     marginBottom: '15px',
//                     fontSize: '14px',
//                   }}
//                 />

//                 <label style={{ fontWeight: '500', color: 'whitesmoke', marginBottom: '5px', fontSize: '14px' }}>
//                   Enter password
//                 </label>
//                 <input
//                   type="password"
//                   value={password}
//                   onChange={(e) => setPassword(e.target.value)}
//                   style={{
//                     fontWeight: 'normal',
//                     outline: 'none',
//                     width: '100%',
//                     border: 'none',
//                     height: '40px',
//                     padding: '10px 20px',
//                     borderRadius: '50px',
//                     marginBottom: '15px',
//                     fontSize: '14px',
//                   }}
//                 />

//                 <label style={{ fontWeight: '500', color: 'whitesmoke', marginBottom: '5px', fontSize: '14px' }}>
//                   Re-Enter Password
//                 </label>
//                 <input
//                   type="password"
//                   value={confirmPassword}
//                   onChange={(e) => setConfirmPassword(e.target.value)}
//                   style={{
//                     fontWeight: 'normal',
//                     outline: 'none',
//                     width: '100%',
//                     border: 'none',
//                     height: '40px',
//                     padding: '10px 20px',
//                     borderRadius: '50px',
//                     marginBottom: '20px',
//                     fontSize: '14px',
//                   }}
//                 />

//                 <button
//                   onClick={handleRegister}
//                   style={{
//                     backgroundColor: '#FFFFFF',
//                     fontWeight: 'bold',
//                     border: 'none',
//                     borderRadius: '50px',
//                     padding: '12px',
//                     cursor: 'pointer',
//                     fontSize: '16px',
//                   }}
//                   onMouseOver={(e) => {
//                     e.target.style.boxShadow = '0px 0px 10px 4px rgba(0,0,0,0.2)';
//                   }}
//                   onMouseOut={(e) => {
//                     e.target.style.boxShadow = 'none';
//                   }}
//                 >
//                   confirm
//                 </button>
//               </div>

//               {/* Book Spine */}
//               <div style={{
//                 position: 'absolute',
//                 left: '50%',
//                 transform: 'translateX(-50%)',
//                 width: '20px',
//                 height: '500px',
//                 background: 'linear-gradient(to right, #8B4513 0%, #654321 50%, #8B4513 100%)',
//                 boxShadow: 'inset 0 0 10px rgba(0,0,0,0.5)',
//                 zIndex: 2,
//               }}></div>
//             </div>
//           )}

//           {/* FORGOT PASSWORD PAGE - OPEN BOOK */}
//           {currentPage === 'forgot' && (
//             <div style={{
//               display: 'flex',
//               position: 'relative',
//               maxWidth: '900px',
//               width: '100%',
//               margin: '0 auto',
//             }}>
//               {/* Left Page - White */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#fff',
//                 borderRadius: '20px 0 0 20px',
//                 boxShadow: '-10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//                 alignItems: 'center',
//                 padding: '50px',
//               }}>
//                 <div style={{ fontSize: '72px', marginBottom: '20px', color: '#d98c19' }}>
//                   🔑
//                 </div>
//                 <div style={{
//                   fontSize: '24px',
//                   color: '#333',
//                   textAlign: 'center',
//                   fontWeight: 'normal',
//                   lineHeight: '1.5',
//                 }}>
//                   We'll help you recover your account
//                 </div>
//               </div>

//               {/* Right Page - Orange with Form */}
//               <div style={{
//                 width: '450px',
//                 height: '500px',
//                 background: '#EB9D2E',
//                 borderRadius: '0 20px 20px 0',
//                 boxShadow: '10px 10px 30px rgba(0, 0, 0, 0.3)',
//                 padding: '50px',
//                 color: 'white',
//                 display: 'flex',
//                 flexDirection: 'column',
//                 justifyContent: 'center',
//               }}>
//                 <h1 style={{
//                   fontSize: '36px',
//                   color: 'whitesmoke',
//                   marginBottom: '10px',
//                   fontWeight: 'bold',
//                 }}>
//                   Forgot password?
//                 </h1>
//                 <p style={{
//                   fontSize: '16px',
//                   color: 'whitesmoke',
//                   marginBottom: '30px',
//                   fontWeight: 'normal',
//                 }}>
//                   Don't worry we got you covered
//                 </p>

//                 <div style={{ position: 'relative', marginBottom: '20px' }}>
//                   <input
//                     type="email"
//                     placeholder="Enter email - example@gmail.com"
//                     value={email}
//                     onChange={(e) => setEmail(e.target.value)}
//                     style={{
//                       fontWeight: 'normal',
//                       outline: 'none',
//                       width: '100%',
//                       border: 'none',
//                       height: '50px',
//                       padding: '10px 45px 10px 20px',
//                       borderRadius: '50px',
//                       fontSize: '14px',
//                     }}
//                   />
//                   <span
//                     onClick={() => setEmail('')}
//                     style={{
//                       position: 'absolute',
//                       right: '20px',
//                       top: '50%',
//                       transform: 'translateY(-50%)',
//                       cursor: 'pointer',
//                       fontSize: '20px',
//                       color: '#666',
//                     }}
//                   >
//                     ✕
//                   </span>
//                 </div>

//                 <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: '10px' }}>
//                   <a
//                     href="#"
//                     onClick={(e) => {
//                       e.preventDefault();
//                       openBook('login');
//                     }}
//                     style={{
//                       fontSize: '14px',
//                       color: 'whitesmoke',
//                       textDecoration: 'none',
//                       fontWeight: 'normal',
//                     }}
//                   >
//                     Try another way?
//                   </a>
//                   <button
//                     onClick={handleForgotPassword}
//                     style={{
//                       backgroundColor: '#FFFFFF',
//                       fontWeight: 'bold',
//                       border: 'none',
//                       borderRadius: '50px',
//                       padding: '12px 30px',
//                       cursor: 'pointer',
//                       fontSize: '16px',
//                     }}
//                     onMouseOver={(e) => {
//                       e.target.style.boxShadow = '0px 0px 10px 4px rgba(0,0,0,0.2)';
//                     }}
//                     onMouseOut={(e) => {
//                       e.target.style.boxShadow = 'none';
//                     }}
//                   >
//                     Confirm
//                   </button>
//                 </div>
//               </div>

//               {/* Book Spine */}
//               <div style={{
//                 position: 'absolute',
//                 left: '50%',
//                 transform: 'translateX(-50%)',
//                 width: '20px',
//                 height: '500px',
//                 background: 'linear-gradient(to right, #8B4513 0%, #654321 50%, #8B4513 100%)',
//                 boxShadow: 'inset 0 0 10px rgba(0,0,0,0.5)',
//                 zIndex: 2,
//               }}></div>
//             </div>
//           )}
//         </div>

//         {/* Footer */}
//         <footer style={{
//           textAlign: 'center',
//           padding: '20px',
//           color: '#ffffff',
//           fontSize: '14px',
//           marginTop: 'auto',
//         }}>
//           © 2025 LibrarySystem.
//         </footer>
//       </div>
//     </div>
//   );
// }


document.addEventListener("DOMContentLoaded", () => {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Get all page containers
    const homePage = document.getElementById("homePage");
    const loginPage = document.getElementById("loginPage");
    const registerPage = document.getElementById("registerPage");
    const forgotPage = document.getElementById("forgotPage");
    
    // Get the book element
    const book = document.querySelector("#homePage .book");
    
    // Get header title
    const headerTitle = document.getElementById("headerTitle");
    
    // Track current page
    let currentPage = "home";
    
    // OPEN BOOK ON LOAD
    book.style.transform = "rotateY(90deg)";
    setTimeout(() => {
        book.style.transform = "rotateY(0deg)";
    }, 300);
    
    // FUNCTION: Navigate between pages
    function navigateToPage(pageName) {
        // Hide all pages
        homePage.classList.remove("active");
        loginPage.classList.remove("active");
        registerPage.classList.remove("active");
        forgotPage.classList.remove("active");
        
        // Show the target page
        if (pageName === "home") {
            homePage.classList.add("active");
            headerTitle.textContent = "LibrarySystem";
        } else if (pageName === "login") {
            loginPage.classList.add("active");
            headerTitle.textContent = "Library System";
        } else if (pageName === "register") {
            registerPage.classList.add("active");
            headerTitle.textContent = "Library System";
        } else if (pageName === "forgot") {
            forgotPage.classList.add("active");
            headerTitle.textContent = "Library System";
        }
        
        currentPage = pageName;
    }
    
    // FUNCTION: Open book animation then navigate
    function openBookAndGo(pageName) {
        const homeBook = document.querySelector("#homePage .book");
        homeBook.classList.add("book-opening");
        
        setTimeout(() => {
            navigateToPage(pageName);
            homeBook.classList.remove("book-opening");
        }, 800);
    }
    
    // FUNCTION: Clear error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('input').forEach(el => el.classList.remove('error'));
    }
    
    // FUNCTION: Display error
    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + 'Error');
        const inputElement = document.getElementById(fieldId);
        if (errorElement) {
            errorElement.textContent = message;
        }
        if (inputElement) {
            inputElement.classList.add('error');
        }
    }
    
    // HOME PAGE BUTTONS
    const registerBtn = document.getElementById("registerBtn");
    registerBtn.addEventListener("click", () => {
        clearErrors();
        openBookAndGo("register");
    });
    
    const loginBtn = document.getElementById("loginBtn");
    loginBtn.addEventListener("click", () => {
        clearErrors();
        openBookAndGo("login");
    });
    
    // HEADER TITLE - Back to home
    headerTitle.addEventListener("click", () => {
        if (currentPage !== "home") {
            clearErrors();
            navigateToPage("home");
        }
    });
    
    // LOGIN FORM
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;
        const submitBtn = loginForm.querySelector('.btn-submit');
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Logging in...';
        
        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Redirect to dashboard or home
                window.location.href = data.redirect || '/dashboard';
            } else {
                // Show errors
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        showError('login' + field.charAt(0).toUpperCase() + field.slice(1), messages[0]);
                    }
                } else {
                    showError('loginEmail', data.message || 'Login failed');
                }
            }
        } catch (error) {
            showError('loginEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Login';
        }
    });
    
    // REGISTER FORM
    const registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        const passwordConfirmation = document.getElementById("confirmPassword").value;
        const submitBtn = registerForm.querySelector('.btn-submit');
        
        // Client-side validation
        if (password !== passwordConfirmation) {
            showError('confirmPassword', 'Passwords do not match!');
            return;
        }
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Registering...';
        
        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    email, 
                    password, 
                    password_confirmation: passwordConfirmation 
                })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Redirect to dashboard or home
                window.location.href = data.redirect || '/dashboard';
            } else {
                // Show errors
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        let errorField = 'register' + field.charAt(0).toUpperCase() + field.slice(1);
                        if (field === 'password_confirmation') {
                            errorField = 'confirmPassword';
                        }
                        showError(errorField, messages[0]);
                    }
                } else {
                    showError('registerEmail', data.message || 'Registration failed');
                }
            }
        } catch (error) {
            showError('registerEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'confirm';
        }
    });
    
    // FORGOT PASSWORD FORM
    const forgotForm = document.getElementById("forgotForm");
    forgotForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearErrors();
        
        const email = document.getElementById("forgotEmail").value;
        const submitBtn = forgotForm.querySelector('.btn-submit');
        
        // Disable button
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        
        try {
            const response = await fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                alert(data.message || 'Password reset link sent to your email!');
                navigateToPage('login');
            } else {
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        showError('forgotEmail', messages[0]);
                    }
                } else {
                    showError('forgotEmail', data.message || 'Failed to send reset link');
                }
            }
        } catch (error) {
            showError('forgotEmail', 'An error occurred. Please try again.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Confirm';
        }
    });
    
    // FORGOT PASSWORD LINK
    const forgotPasswordLink = document.getElementById("forgotPasswordLink");
    forgotPasswordLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("forgot");
    });
    
    // TO REGISTER LINK
    const toRegisterLink = document.getElementById("toRegisterLink");
    toRegisterLink.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("register");
    });
    
    // TRY ANOTHER WAY LINK
    const tryAnotherWay = document.getElementById("tryAnotherWay");
    tryAnotherWay.addEventListener("click", (e) => {
        e.preventDefault();
        clearErrors();
        navigateToPage("login");
    });
    
    // CLEAR EMAIL BUTTON (Forgot Password)
    const clearBtn = document.querySelector(".clear-btn");
    clearBtn.addEventListener("click", () => {
        document.getElementById("forgotEmail").value = "";
    });
});