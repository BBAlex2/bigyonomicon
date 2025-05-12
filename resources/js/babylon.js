const babylonCanvas = document.getElementById("babylonCanvas");

if (babylonCanvas) {
    const productId = babylonCanvas.dataset.productid;
    var createScene = function () {
        var scene = new BABYLON.Scene(engine);
        const assetsManager = new BABYLON.AssetsManager(scene);
    
        const camera = new BABYLON.ArcRotateCamera("Camera", Math.PI, Math.PI/3, 7, new BABYLON.Vector3(0, 0, 0), scene);
        camera.attachControl(babylonCanvas, true);
    
        var light = new BABYLON.HemisphericLight("light", new BABYLON.Vector3(0, 1, 0), scene);
        light.intensity = 0.666;

        scene.clearColor = new BABYLON.Color3(0.1, 0.11, 0.12);

        // .obj vagy .babylon mesh importálása, együtt a hozzá tartozó .mtl és .png fájlokkal
        var mesh = BABYLON.ImportMeshAsync("/productModel/bigyo" + productId + ".obj");

        return scene;
    };

    const engine = new BABYLON.Engine(babylonCanvas, true);
    const scene = createScene();

    engine.runRenderLoop(function () {
        scene.render();
    });
    window.addEventListener("resize", function () {
        engine.resize();
    });
}
