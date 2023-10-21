function initializeWebSocket() {
    const webSocket = new WebSocket('wss://192.168.100.128:81/', ['arduino']);

    webSocket.onopen = () => {
      console.log('Connected to WebSocket server');
      webSocket.send('Connect ' + new Date());
    };

    webSocket.onerror = (error) => {
      console.error('WebSocket Error', error);
    };

    webSocket.onmessage = (event) => {
      console.log('Received message:', event.data);

      const data = JSON.parse(event.data); // Parsear el mensaje JSON
      document.dispatchEvent(new CustomEvent('temperatureUpdate', { detail: data.temperature }));
      document.dispatchEvent(new CustomEvent('humidityUpdate', { detail: data.humidity }));
      document.dispatchEvent(new CustomEvent('temperatureUpdate2', { detail: data.temperature2 }));
      document.dispatchEvent(new CustomEvent('humidityUpdate2', { detail: data.humidity2 }));
      document.dispatchEvent(new CustomEvent('waterLevelUpdate', { detail: data.waterLevelStr }));

    };
  }

  // Llamada a la función para iniciar el WebSocket
  initializeWebSocket();
