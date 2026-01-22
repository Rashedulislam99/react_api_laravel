<!DOCTYPE html>
<html>
<head>
<style>
body {
  height: 100vh;
  margin: 0;
  position: relative;
  overflow: hidden;
  background: #000;
}

#text {
  position: absolute;
  font-size: 40px;
  color: yellow;
  animation: moveAll 8s linear infinite;
}

@keyframes moveAll {
  0%   { left: 0;   top: 0; }
  25%  { left: 70%; top: 0; }     /* left → right */
  50%  { left: 70%; top: 70%; }   /* up → down */
  75%  { left: 0;   top: 70%; }   /* right → left */
  100% { left: 0;   top: 0; }     /* down → up */
}
</style>
</head>

<body>
  <div id="text">
    ❤️ WELCOME MR. MD RASHEDUL ISLAM ❤️
  </div>
</body>
</html>
