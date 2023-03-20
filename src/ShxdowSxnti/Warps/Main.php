<?php

namespace ShxdowSxnti\Warps;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use ShxdowSxnti\Warps\PluginUtils;

use pocketmine\Server;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\AnimatePacket;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;
use pocketmine\utils\Config;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\level\sound\PopSound;
use ShxdowSxnti\Warps\libs\jojoe77777\FormAPI\SimpleForm;
use pocketmine\world\World;
use pocketmine\world\WorldManager;
use pocketmine\utils\Utils;


class Main extends PluginBase implements Listener {
    
  
  public  function onEnable(): void {
      $this->saveResource("config. yml");
        $this->getLogger()->info("Warps plugin prendio correctamente");
         $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Mina_2"));
    
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Mina_3"));
    
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Mina_1"));
    
$this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Warp_1"));

$this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Game_3"));

$this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Game_2"));

$this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Game_1"));

$this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Warp_3"));
      $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("Warp_2"));
} 

public function onDisable(): void {
        $this->getLogger()->info("Warps plugin apagado con exito");
    }

public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if($command->getName() == "mundos"){
            if($sender instanceof Player){
                $this->WarpUse($sender);
                 PluginUtils::PlaySound($sender, "use.slime", 1, 2);
                }else{
                 $this->WarpUse($sender);
                 PluginUtils::PlaySound($sender, "use.slime", 1, 2);
            }
        }

        return true;
    }
    public function WarpUse($player){
        $form = new SimpleForm (function ($player, $data){
    $result = $data;        
            if($result === null){
                return true;
            }
    switch($result){
        case 0:

$this->getMinaForm($player);  
  PluginUtils::PlaySound($player, "break.tuff", 1, 1);
  break;
  case 1:
  
$this->getGamesForm($player);
PluginUtils::PlaySound($player, "break.tuff", 1, 1);
break;
case 2:

$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_1"))->getSpawnLocation());
PluginUtils::PlaySound($player, "break.tuff", 1, 1);
break;
case 3:

$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_2"))->getSpawnLocation());
PluginUtils::PlaySound($player, "break.tuff", 1, 1);
break;
case 4:
 
$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_3"))->getSpawnLocation()); 
            PluginUtils::PlaySound($player, "break.tuff", 1, 1);
            break;
            case 5:


   break;
        
        
    }
   });
   
   $form->setTitle($this->getConfig()->get("Titulo-Warps"));
   
   $form->addButton($this->getConfig()->get("Minas_Boton"),0,($this->getConfig()->get("image_minas")));
   
   $form->addButton($this->getConfig()->get("MiniGames_Boton"),0,($this->getConfig()->get("image_minigames")));
  
   $form->addButton(($this->getConfig()->get("Title_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_1"))->getPlayers()), 0, ($this->getConfig()->get("image_1")));
   
   $form->addButton(($this->getConfig()->get("Title_2")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_2"))->getPlayers()), 0, ($this->getConfig()->get("image_2")));
        $form->addButton(($this->getConfig()->get("Title_3" )).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Warp_3"))->getPlayers()), 0, ($this->getConfig()->get("image_3")));
 	
 	$form->addButton("§l§cSalir",0,"textures/ui/redX1");
		$form->sendToPlayer($player);
   
   
  }
  
  	public function getGamesForm($player){
		$form = new SimpleForm(function ($player, $data){
		$result = $data;
		if($result === null){
			return true;
			}
			switch($result){
				case 0:
				
				$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_1"))->getSpawnLocation()); 


				break;
				case 1:
				
				$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_2"))->getSpawnLocation()); 
                     

				break;
				case 2:
				
				$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_3"))->getSpawnLocation()); 

				
				break;
				case 3:
				    
				    $this->WarpUse($player);


				
				
				    } 
				});
				
			$form->setTitle($this->getConfig()->get("Minigames_text"));
				$form->addButton(($this->getConfig()->get("Bosses_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_1"))->getPlayers()), 0, ($this->getConfig()->get("game_image_1")));
				
				$form->addButton(($this->getConfig()->get("Koth_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_2"))->getPlayers()), 0, ($this->getConfig()->get("game_image_2")));
				
				$form->addButton(($this->getConfig()->get("Ffa_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Game_3"))->getPlayers()), 0, ($this->getConfig()->get("game_image_3")));
				
				$form->addButton("§l§cSALIR",0,"textures/ui/redX1");
		$form->sendToPlayer($player);
 	
 			
		}
		
               public function getMinaForm($player){
		$form = new SimpleForm(function ($player, $data){
		$result = $data;
		if($result === null){
			return true;
			}
			switch($result){
				case 0:
				
				$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_1"))->getSpawnLocation()); 
                     

				break;
				case 1:
				
				$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_2"))->getSpawnLocation()); 
                     

				break;
				case 2:
				
				if (!$player->hasPermission("minavip.perm")) {
            $player->sendMessage(TextFormat::colorize("&cYou have don´t permissions for this commmand"));
            return;
			} 	$player->teleport($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_3"))->getSpawnLocation()); 
                     
				
				break;
				case 3:
				    
				    $this->WarpUse($player);
                     
				    
				
				
				    } 
				}); 
				$form->setTitle($this->getConfig()->get("Minas_text"));
				$form->addButton(($this->getConfig()->get("Pvp_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_1"))->getPlayers()), 0, ($this->getConfig()->get("mina_image_1")));
				
				$form->addButton(($this->getConfig()->get("Normal_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_2"))->getPlayers()), 0, ($this->getConfig()->get("mina_image_2")));
				$form->addButton(($this->getConfig()->get("Vip_1")).count($this->getServer()->getWorldManager()->getWorldByName($this->getConfig()->get("Mina_3"))->getPlayers()), 0, ($this->getConfig()->get("mina_image_3")));
				
				$form->addButton("§l§cSALIR",0,"textures/ui/redX1");
		$form->sendToPlayer($player);
 	
				
				} 
}
