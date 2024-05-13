// Crear un diagrama GoJS en el div con el ID "myDiagramDiv"

// Resto del código para definir la plantilla de nodo, los datos del diagrama, etc.


// Crear un diagrama GoJS
var diagram = new go.Diagram("myDiagramDiv");

// Definir una plantilla de nodo
diagram.nodeTemplate =
  $(go.Node, "Auto",
    { background: "white" },
    $(go.Shape,
      { fill: "lightgray", strokeWidth: 0 },
      new go.Binding("fill", "color")),
    $(go.TextBlock,
      { margin: 5 },
      new go.Binding("text", "name"))
  );

// Definir los datos del diagrama
var jsonData = [
  { key: 1, name: "Node 1", color: "red", parent: 0 },
  { key: 2, name: "Node 2", color: "blue", parent: 0 },
  { key: 3, name: "Node 3", color: "green", parent: 0 }
];

diagram.model = new go.TreeModel(jsonData);

// Dibujar el diagrama
diagram.requestUpdate();


